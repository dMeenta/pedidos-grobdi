<?php

namespace App\Http\Controllers\pedidos\Motorizado;

use App\Events\PedidosNotification;
use App\Http\Controllers\Controller;
use App\Models\PedidosDeliveryState;
use App\Models\Pedidos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Typography\FontFactory;

class PedidosMotoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $zones = $user->zones->pluck('id');

        $fechaPedidos = $request->query("fecha") ? Carbon::parse($request->validate(['fecha' => 'required|date'])['fecha'])->startOfDay() : now()->toDateString();

        $pedidos_zona = Pedidos::whereIn('zone_id', $zones)
            ->whereDate('deliveryDate', $fechaPedidos)
            ->where('productionStatus', true)
            ->get();

        return view('pedidos.motorizado.pedidos.index', ['pedidos_zona' => $pedidos_zona, 'i' => 0]);
    }

    public function edit($pedido)
    {
        $pedido = Pedidos::find($pedido);
        // dd($pedido->deliveryStatus);
        return view('pedidos.motorizado.pedidos.edit', compact('pedido'));
    }
    public function update(Request $request, $id)
    {
        // dd(request()->all());
        $pedidos = Pedidos::find($id);
        $pedidos->deliveryStatus = $request->deliveryStatus;
        $pedidos->detailMotorizado = $request->detailMotorizado;
        $pedidos->user_id = Auth::user()->id;
        $pedidos->save();
        // dd($pedidos);
        // Dispatch the event with the post data
        event(new PedidosNotification([
            'orderId' => $pedidos->orderId,
            'estado_entrega' => $pedidos->deliveryStatus,
            'detalles_motorizado' => $pedidos->detailMotorizado,
            'nombre_usuario' => Auth::user()->name
        ]));
        return redirect()->route('pedidosmotorizado.index')
            ->with('success', 'Pedido modificado exitosamente');
    }

    public function updatePedidoByMotorizado(Request $request, $id)
    {
        $pedido = Pedidos::findOrFail($id);

        if ($request->state == 'Entregado' && (!$request->hasFile('fotoEntrega'))) {
            return response()->json(['success' => false, 'message' => 'Para marcar el pedido como ENTREGADO, necesita subir una foto del momento de la entrega'], 400);
        }

        if (!$request->hasFile('fotoDomicilio')) {
            return response()->json(['success' => false, 'message' => 'No se puede cambiar el estado del pedido sin una foto del domicilio.'], 400);
        }

        if ($pedido->currentDeliveryState) {
            if (trim(strtolower($pedido->currentDeliveryState->state)) === 'entregado') {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede actualizar el estado del pedido porque ya fue marcado como ENTREGADO'
                ], 400);
            }
        };

        $pedidoEstado = new PedidosDeliveryState();

        $pedidoEstado->pedido_id = $pedido->id;
        $pedidoEstado->state = $request->state;
        $pedidoEstado->motorizado_id = Auth::id();
        $pedidoEstado->observacion = $request->detailMotorizado;

        $fields = [
            'fotoDomicilio' => [
                'folder' => 'images/fotoDomicilio',
                'db_field' => 'foto_domicilio',
            ],
            'fotoEntrega' => [
                'folder' => 'images/fotos_entrega',
                'db_field' => 'foto_entrega',
            ],
        ];

        foreach ($fields as $inputName => $config) {
            if ($request->hasFile($inputName)) {
                $imagen = $request->file($inputName);

                $extension = '.' . $imagen->getClientOriginalExtension();

                $imageName = $pedido->orderId . '_' . time() . $extension;

                $img = Image::read($imagen->getRealPath());

                $img->resize(800, 700, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $path = public_path($config['folder'] . '/' . $imageName);

                $img->save($path);

                $pedidoEstado->{$config['db_field']} = $config['folder'] . '/' . $imageName;
            }
        }

        if (!$request->latitude || !$request->longitude) {
            return response()->json(['success' => false, 'message' => 'Se requiere su ubicación actual para actualizar el estado del pedido.'], 400);
        }

        $pedidoEstado->save();

        $pedidoEstado->location()->create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['success' => true, 'message' => 'Pedido actualizado exitosamente.'], 200);
    }

    public function cargarFotos(Request $request, $id)
    {

        $pedidos = Pedidos::find($id);

        if ($request->fotoDomicilio) {
            $imagen = $request->file("fotoDomicilio");
            $img_ext = explode(".", $imagen->getClientOriginalName());
            $extension = '.' . $img_ext[1];
            $imageNameDomicilio = $pedidos->orderId . '_' . time() . $extension;
            //$imageNameReceta = time().'.'.$request->receta->extension();
            $img = Image::read($imagen->getRealPath());

            // Redimensionar la imagen
            $img->resize(800, 700, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $path = public_path('images/fotoDomicilio/' . $imageNameDomicilio);
            $img->save($path);
            $pedidos->fotoDomicilio = 'images/fotoDomicilio/' . $imageNameDomicilio;
            $pedidos->fechaFotoDomicilio = now();
            $pedidos->save();
        }
        if ($request->fotoEntrega) {
            $imagen = $request->file("fotoEntrega");
            $img_ext = explode(".", $imagen->getClientOriginalName());
            $extension = '.' . $img_ext[1];
            $imageNameEntrega = $pedidos->orderId . '_' . time() . $extension;
            //$imageNameReceta = time().'.'.$request->receta->extension();
            $img = Image::read($imagen->getRealPath());

            // Redimensionar la imagen
            $img->resize(800, 700, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $path = public_path('images/fotos_entrega/' . $imageNameEntrega);
            $img->save($path);
            $pedidos->fotoEntrega = 'images/fotos_entrega/' . $imageNameEntrega;
            $pedidos->fechaFotoEntrega = now();
            $pedidos->save();
        }

        return back()->with('success', 'Pedido modificado exitosamente');
    }
}

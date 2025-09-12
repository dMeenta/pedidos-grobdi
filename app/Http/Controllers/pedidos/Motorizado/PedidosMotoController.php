<?php

namespace App\Http\Controllers\pedidos\Motorizado;

use App\Events\PedidosNotification;
use App\Http\Controllers\Controller;
use App\Models\PedidosDeliveryState;
use App\Models\Location;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class PedidosMotoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $zones = $user->zones->pluck('id');

        $fechaPedidos = $request->query("fecha") ? Carbon::parse($request->validate(['fecha' => 'required|date'])['fecha'])->startOfDay() : now()->toDateString();

        $pedidos_zona = Pedidos::whereIn('zone_id', $zones)
            ->whereDate('deliveryDate', $fechaPedidos)
            ->whereDoesntHave('currentDeliveryState', function ($q) {
                $q->where('state', 'entregado');
            })
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
        $pedido = Pedidos::findOrFail(id: $id);

        if (!$request->lat_foto_domicilio || !$request->lng_foto_domicilio) {
            return response()->json(['success' => false, 'message' => 'Se requiere la ubicación para actualizar el estado del pedido'], 400);
        }

        $isEntregadoState = $request->state == 'Entregado';

        $rules = [
            'foto_domicilio' => 'required|image'
        ];

        if ($isEntregadoState) {
            $rules['foto_entrega'] = 'required|image';
            $rules['receptor_nombre'] = 'required|string';
            $rules['receptor_firma'] = 'required|string';

            if (!$request->lat_foto_entrega || !$request->lng_foto_entrega) {
                return response()->json(['success' => false, 'message' => 'Se requiere la ubicación para actualizar el estado del pedido'], 400);
            }
        }

        $request->validate($rules);

        if ($pedido->currentDeliveryState && trim(strtolower($pedido->currentDeliveryState->state)) === 'entregado') {
            return response()->json([
                'success' => false,
                'message' => 'No se puede actualizar el estado del pedido porque ya fue marcado como ENTREGADO'
            ], 400);
        };

        $fields = [
            'foto_domicilio' => [
                'folder' => 'images/fotoDomicilio',
                'type' => Location::TYPE_FOTO_DOMICILIO,
                'lat_field' => 'lat_foto_domicilio',
                'lng_field' => 'lng_foto_domicilio',
            ],
            'foto_entrega' => [
                'folder' => 'images/fotos_entrega',
                'type' => Location::TYPE_FOTO_ENTREGA,
                'lat_field' => 'lat_foto_entrega',
                'lng_field' => 'lng_foto_entrega',
            ],
        ];

        $fieldsToProcess = $isEntregadoState ? $fields : ['foto_domicilio' => $fields['foto_domicilio']];

        $pedidoEstado = new PedidosDeliveryState();

        $pedidoEstado->pedido_id = $pedido->id;
        $pedidoEstado->state = $request->state;
        $pedidoEstado->motorizado_id = Auth::id();
        $pedidoEstado->observacion = $request->detailMotorizado;

        foreach ($fieldsToProcess as $inputName => $config) {
            $imagen = $request->file($inputName);
            $extension = '.' . $imagen->getClientOriginalExtension();
            $imgName = $pedido->orderId . '_' . time() . $extension;

            $img = Image::read($imagen->getRealPath());
            $img->resize(800, 700, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $path = public_path($config['folder'] . '/' . $imgName);
            $img->save($path);

            $pedidoEstado->{$inputName} = $config['folder'] . '/' . $imgName;
            $pedidoEstado->{'datetime_' . $inputName} = $request->input('datetime_' . $inputName);
        }

        if ($isEntregadoState) {
            $pedidoEstado->receptor_nombre = $request->input('receptor_nombre');

            $firmaData = $request->input('receptor_firma');
            if ($firmaData) {
                $firma = str_replace('data:image/png;base64,', '', $firmaData);
                $firma = str_replace(' ', '+', $firma);
                $firmaName = 'firma_receptor_' . $pedido->orderId . '_' . time() . '.png';
                $firmaFolder = 'images/firma_receptor';

                // Crear la carpeta si no existe
                if (!file_exists(public_path($firmaFolder))) {
                    mkdir(public_path($firmaFolder), 0755, true);
                }

                $firmaPath = $firmaFolder . '/' . $firmaName;

                file_put_contents(public_path($firmaPath), base64_decode($firma));

                $pedidoEstado->receptor_firma = $firmaPath;
            }
        }

        $pedidoEstado->save();

        foreach ($fieldsToProcess as $inputName => $config) {
            $lat = $request->input($config['lat_field']);
            $lng = $request->input($config['lng_field']);

            if ($lat && $lng) {
                $pedidoEstado->location()->create([
                    'type' => $config['type'],
                    'latitude' => $lat,
                    'longitude' => $lng,
                ]);
            }
        }

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

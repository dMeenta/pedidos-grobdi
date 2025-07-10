<?php
namespace App\Http\Controllers\softlyn;

use App\Http\Controllers\Controller;
use App\Models\GuiaIngreso;
use App\Models\DetalleGuiaIngreso;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Articulo;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuiaIngresoController extends Controller
{
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            $guia = GuiaIngreso::with('detalles.lote.articulo')->findOrFail($id);
            foreach ($guia->detalles as $detalle) {
                if ($detalle->lote && $detalle->lote->articulo) {
                    $detalle->lote->articulo->decrement('stock', $detalle->cantidad);
                }
                $detalle->delete();
            }
            $guia->delete();
            \DB::commit();
            return redirect()->route('guia_ingreso.index')->with('success', 'Guía de ingreso eliminada y stock revertido correctamente.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->route('guia_ingreso.index')->with('error', 'Error al eliminar la guía: ' . $e->getMessage());
        }
    }
    /**
     * Devuelve todos los lotes de un artículo (AJAX)
     */
    public function getLotesPorArticulo($articulo_id)
    {
        $lotes = Lote::where('articulo_id', $articulo_id)->get(['id', 'num_lote', 'fecha_vencimiento']);
        return response()->json($lotes);
    }
    public function index()
    {
        $guias = GuiaIngreso::with('compra')->orderBy('fecha', 'desc')->get();
        return view('guia_ingreso.index', compact('guias'));
    }

    public function create()
    {
        // Todas las compras disponibles (facturas)
        $compras = Compra::whereHas('detalles', function($q) {
            $q->whereRaw('cantidad > (
                SELECT COALESCE(SUM(cantidad),0)
                FROM detalle_guia_ingreso
                WHERE detalle_compra_id = detalle_compra.id
            )');
        })->orderBy('fecha_emision', 'desc')->get();
        return view('guia_ingreso.create', compact('compras'));
    }

    public function getDetallesCompra($compra_id)
    {
        // Devuelve los detalles de la compra seleccionada (AJAX)
        $detalles = DetalleCompra::with([
            'articulo.insumos.unidadMedida',
            'articulo.empaques.unidadMedida',
            'detalleGuiaIngresos'
        ])->where('compra_id', $compra_id)->get();

        $detalles = $detalles->map(function ($detalle) {
            $articulo = $detalle->articulo;
            $unidad = 'und';
            $sku = '';
            $nombre = '';
            if ($articulo) {
                $sku = $articulo->sku ?? '';
                $nombre = $articulo->nombre ?? '';
                $tipo = $articulo->tipo ?? '';
                try {
                    switch ($tipo) {
                        case 'insumo':
                            $unidad = optional($articulo->insumos->first()?->unidadMedida)->nombre_unidad_de_medida ?? 'und';
                            break;
                        case 'material':
                        case 'envase':
                            $empaque = $articulo->empaques->where('tipo', $tipo)->first();
                            $unidad = optional($empaque?->unidadMedida)->nombre_unidad_de_medida ?? 'und';
                            break;
                        case 'empaque':
                            $unidad = optional($articulo->empaques->first()?->unidadMedida)->nombre_unidad_de_medida ?? 'und';
                            break;
                        default:
                            $unidad = $articulo->unidad ?? 'und';
                            break;
                    }
                } catch (\Exception $e) {
                    $unidad = 'und';
                }
            }
            $detalleArray = $detalle->toArray();
            $detalleArray['articulo'] = [
                'sku' => $sku,
                'nombre' => $nombre,
                'unidad' => $unidad
            ];
            return $detalleArray;
        });
        return response()->json($detalles);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'fecha' => 'required|date',
                'compra_id' => 'required|exists:compras,id',
                'detalles' => 'required|array|min:1',
                'detalles.*.detalle_compra_id' => 'required|exists:detalle_compra,id',
                'detalles.*.lote' => 'required|string|max:50',
                'detalles.*.fecha_vencimiento' => 'required|date',
                'detalles.*.cantidad' => 'required|integer|min:1',
            ]);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return back()->withErrors($ex->validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $guia = GuiaIngreso::create([
                'nombre' => $request->nombre,
                'fecha' => $request->fecha,
                'compra_id' => $request->compra_id,
            ]);

            foreach ($request->detalles as $detalle) {
                $detalleCompra = DetalleCompra::find($detalle['detalle_compra_id']);
                // Calcular el total ya ingresado para este detalle de compra
                $totalIngresado = DetalleGuiaIngreso::where('detalle_compra_id', $detalleCompra->id)->sum('cantidad');
                $pendiente = $detalleCompra->cantidad - $totalIngresado;
                if ($detalle['cantidad'] > $pendiente) {
                    DB::rollBack();
                    return back()->withInput()->with('error', 'No puede ingresar más de lo pendiente para el producto: ' . ($detalleCompra->articulo->nombre ?? ''));
                }

                // Lógica para lote manual o existente
                $articulo_id = $detalleCompra->articulo_id;
                $lote_id = $detalle['lote_id'] ?? null;
                if ($lote_id) {
                    // Usar lote existente
                    $lote = Lote::find($lote_id);
                    // Si por alguna razón el lote no existe, fallback a crear manual
                    if (!$lote) {
                        $lote = Lote::firstOrCreate([
                            'articulo_id' => $articulo_id,
                            'num_lote' => $detalle['lote'],
                            'fecha_vencimiento' => $detalle['fecha_vencimiento'],
                        ]);
                    }
                } else {
                    // Buscar o crear lote manualmente por artículo+num_lote+fecha_vencimiento
                    $lote = Lote::firstOrCreate([
                        'articulo_id' => $articulo_id,
                        'num_lote' => $detalle['lote'],
                        'fecha_vencimiento' => $detalle['fecha_vencimiento'],
                    ]);
                }

                DetalleGuiaIngreso::create([
                    'guia_ingreso_id' => $guia->id,
                    'lote_id' => $lote->id,
                    'fecha_vencimiento' => $detalle['fecha_vencimiento'],
                    'cantidad' => $detalle['cantidad'],
                    'detalle_compra_id' => $detalleCompra->id,
                ]);

                // Actualizar stock del artículo
                $articulo = $detalleCompra->articulo;
                $articulo->increment('stock', $detalle['cantidad']);
            }

            DB::commit();
            return redirect()->route('guia_ingreso.index')->with('success', 'Guía de ingreso registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al registrar la guía de ingreso: ' . $e->getMessage());
        }
    }
}

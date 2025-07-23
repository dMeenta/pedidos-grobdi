<?php

namespace App\Http\Controllers\cotizador;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Insumo;
use App\Models\Articulo;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use App\Models\ProductoFinal;

class InsumoController extends Controller
{
    public function index()
    {
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        $estado = request()->estado;

        if ($estado == 'inactivo') {
            $insumos = Insumo::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) {
                $query->where('estado', 'inactivo');
            })->orderBy('id', 'desc')->get();
        } else {
            $insumos = Insumo::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) {
                $query->where('estado', 'activo');
            })->orderBy('id', 'desc')->get();
        }

        return view('cotizador.administracion.insumo.index', compact('insumos', 'unidades'));
    }

    public function create()
    {
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        return view('cotizador.administracion.insumo.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:255|unique:articulos,nombre,',
            'precio' => 'required|numeric|min:0',
            'unidad_de_medida_id' => 'required|exists:unidad_de_medida,id',
            'es_caro' => 'nullable|boolean',
        ];
        $mensaje = ['nombre.unique' => 'El nombre del insumo ya está en uso. Por favor, elige otro nombre.'];
        
        $request->validate($rules, $mensaje);
        
        // Crear el artículo para el insumo
        $articulo = Articulo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion ?? null, 
            'tipo' => 'insumo', 
            'stock' => 0, 
        ]);

        // Crear el insumo y asociarlo al artículo
        Insumo::create([
            'precio' => $request->precio,
            'unidad_de_medida_id' => $request->unidad_de_medida_id,
            'es_caro' => false,
            'articulo_id' => $articulo->id,
        ]);

        return redirect()->route('insumos.index')->with('success', 'Insumo creado correctamente.');
    }

    public function show($id)
    {
        $insumo = Insumo::with(['articulo', 'unidadMedida'])->findOrFail($id);
        return view('cotizador.administracion.insumo.show', compact('insumo'));
    }

    public function edit($id)
    {
        $insumo = Insumo::with(['articulo', 'unidadMedida'])->findOrFail($id);
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        return view('cotizador.administracion.insumo.edit', compact('insumo', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);

        $rules = [
            'nombre' => 'required|string|max:255|unique:articulos,nombre,' . $insumo->articulo->id,
            'precio' => 'required|numeric|min:0',
            'unidad_de_medida_id' => 'required|exists:unidad_de_medida,id',
        ];
        $mensaje = ['nombre.unique' => 'El nombre del insumo ya está en uso. Por favor, elige otro nombre.'];

        $request->validate($rules, $mensaje);

        // Actualizar el artículo asociado al insumo
        $articulo = $insumo->articulo;
        if ($articulo) {
            $articulo->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion ?? null,
                'estado' => $request->estado ?? 'activo',
            ]);
        }

        // Actualizar el insumo
        $insumo->update([
            'precio' => $request->precio,
            'unidad_de_medida_id' => $request->unidad_de_medida_id,
        ]);

        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $insumo = Insumo::with('articulo')->find($id);

        if ($insumo && $insumo->articulo) {
            $articulo = $insumo->articulo;
            if ($articulo->estado === 'inactivo') {
                return redirect()->back()->with('error', 'Insumo inactivo. Para activarlo, por favor use la sección de editar.');
            }

            $articulo->update(['estado' => 'inactivo']);

            return redirect()->route('insumos.index', ['estado' => 'inactivo'])
                ->with('success', 'Insumo inactivado correctamente.');
        }

        return redirect()->route('insumos.index')
            ->withErrors('Insumo no encontrado.');
    }

        //Contabilidad va a marcar si es caro o no
        public function marcarCaro(Request $request)
    {
        $esCaro = $request->input('es_caro');

        $insumos = Insumo::with(['articulo', 'unidadMedida'])
            ->when($esCaro !== null, function ($query) use ($esCaro) {
                $query->where('es_caro', $esCaro);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('cotizador.contabilidad.marcar_caro', compact('insumos', 'esCaro'));
    }

        public function actualizarEsCaro(Request $request)
    {
        foreach ($request->insumos as $id => $valor) {
            $insumo = Insumo::find($id);
            if (!$insumo) continue;

            // 1. Actualizar campo es_caro
            $insumo->es_caro = $valor === '1';
            $insumo->save();

            $productosFinalesIds = collect();

            // A. ProductoFinal que usa el insumo directamente
            $directos = $insumo->productosFinales()->pluck('producto_final.id');
            $productosFinalesIds = $productosFinalesIds->merge($directos);

            // B. ProductoFinal que usa el insumo mediante base final
            $basesFinalesConInsumo = DB::table('base_insumo')
                ->join('base', 'base.id', '=', 'base_insumo.base_id')
                ->where('base_insumo.insumo_id', $insumo->id)
                ->where('base.tipo', 'final')
                ->pluck('base.id');

            $productosPorBases = DB::table('producto_final_base')
                ->whereIn('base_id', $basesFinalesConInsumo)
                ->pluck('producto_final_id');

            $productosFinalesIds = $productosFinalesIds->merge($productosPorBases);

            // C. ProductoFinal que usa base final que usa una prebase que usa el insumo
            $prebasesConInsumo = DB::table('base_insumo')
                ->join('base', 'base.id', '=', 'base_insumo.base_id')
                ->where('base.tipo', 'prebase')
                ->where('base_insumo.insumo_id', $insumo->id)
                ->pluck('base.id');

            $basesFinalesConPrebases = DB::table('base_prebase')
                ->whereIn('prebase_id', $prebasesConInsumo)
                ->pluck('base_id');

            $productosPorPrebases = DB::table('producto_final_base')
                ->whereIn('base_id', $basesFinalesConPrebases)
                ->pluck('producto_final_id');

            $productosFinalesIds = $productosFinalesIds->merge($productosPorPrebases);

            // D. Recalcular productos finales únicos
            $productos = ProductoFinal::whereIn('id', $productosFinalesIds->unique())->get();

            foreach ($productos as $producto) {
                $producto->calcularCostos();
            }
        }

        return redirect()->route('insumos.marcar-caro')->with('success', 'Actualización realizada correctamente.');
    }
}

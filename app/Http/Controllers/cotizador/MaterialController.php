<?php

namespace App\Http\Controllers\cotizador;
use App\Http\Controllers\Controller;

use App\Models\Empaque;
use App\Models\Articulo;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $estado = request()->estado;

        if ($estado == 'inactivo') {
            $empaques = Empaque::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) {
                $query->where('estado', 'inactivo');
            })->where('tipo', 'material')->orderBy('id', 'desc')->get();
        } else {
            $empaques = Empaque::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) {
                $query->where('estado', 'activo');
            })->where('tipo', 'material')->orderBy('id', 'desc')->get();
        }

        return view('cotizador.administracion.material.index', compact('empaques'));
    }

    public function create()
    {
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        return view('cotizador.administracion.material.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:255|unique:articulos,nombre,',
            'precio' => 'required|numeric|min:0',
        ];
        $mensaje = ['nombre.unique' => 'El nombre del empaque ya está en uso. Por favor, elige otro nombre.'];

        $request->validate($rules, $mensaje);

        // Crear el artículo para el empaque
        $articulo = Articulo::create([
            'nombre' => $request->nombre,
            'tipo' => 'material',
            'stock' => 0, 
        ]);

        // Crear el empaque y asociarlo al artículo
        Empaque::create([
            'tipo' => 'material',
            'precio' => $request->precio,
            'articulo_id' => $articulo->id,
        ]);

        return redirect()->route('material.index')->with('success', 'Material creado correctamente.');
    }

    public function show($id)
    {
        $empaque = Empaque::with('articulo')->where('tipo', 'material')->findOrFail($id);
        return view('cotizador.administracion.material.show', compact('empaque'));
    }

    public function edit($id)
    {
        $empaque = Empaque::with('articulo')->where('tipo', 'material')->findOrFail($id);
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        return view('cotizador.administracion.material.edit', compact('empaque', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        $empaque = Empaque::where('tipo', 'material')->findOrFail($id);

        $rules = [
            'nombre' => 'required|string|max:255|unique:articulos,nombre,' . $empaque->articulo->id,
            'precio' => 'required|numeric|min:0',
        ];
        $mensaje = ['nombre.unique' => 'El nombre del empaque ya está en uso. Por favor, elige otro nombre.'];

        $request->validate($rules, $mensaje);

        // Actualizar el artículo asociado al empaque
        $articulo = $empaque->articulo;
        if ($articulo) {
            $articulo->update([
                'nombre' => $request->nombre,
                'estado' => $request->estado ?? 'activo',
                'tipo' => 'material',
            ]);
        }

        // Actualizar el empaque
        $empaque->update([
            'tipo' => 'material',
            'precio' => $request->precio,
        ]);

        return redirect()->route('material.index')->with('success', 'Material actualizado correctamente.');
    }

    public function destroy($id)
    {
        $empaque = Empaque::with('articulo')->where('tipo', 'material')->find($id);

        if ($empaque && $empaque->articulo) {
            $articulo = $empaque->articulo;
            if ($articulo->estado === 'inactivo') {
                return redirect()->back()->with('error', 'Material inactivo. Para activarlo, por favor use la sección de editar.');
            }

            $articulo->update(['estado' => 'inactivo']);

            return redirect()->route('material.index', ['estado' => 'inactivo'])
                ->with('success', 'Material inactivado correctamente.');
        }

        return redirect()->route('material.index')
            ->withErrors('Material no encontrado.');
    }
}

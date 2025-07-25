<?php

namespace App\Http\Controllers\cotizador;
use App\Http\Controllers\Controller;

use App\Models\Empaque;
use App\Models\Articulo;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class EnvaseController extends Controller
{
    public function index()
    {
        $estado = request()->estado;

        if ($estado == 'inactivo') {
            $envases = Empaque::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) {
                $query->where('estado', 'inactivo');
            })->where('tipo', 'envase')->orderBy('id', 'desc')->get();
        } else {
            $envases = Empaque::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) {
                $query->where('estado', 'activo');
            })->where('tipo', 'envase')->orderBy('id', 'desc')->get();
        }

        return view('cotizador.administracion.envases.index', compact('envases'));
    }

    public function create()
    {
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        return view('cotizador.administracion.envases.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string|max:255|unique:articulos,nombre,',
            'precio' => 'required|numeric|min:0',
        ];
        $mensaje = ['nombre.unique' => 'El nombre del envase ya está en uso. Por favor, elige otro nombre.'];

        $request->validate($rules, $mensaje);

        // Crear el artículo para el envase
        $articulo = Articulo::create([
            'nombre' => $request->nombre,
            'tipo' => 'envase',
            'stock' => 0, 
        ]);

        // Crear el empaque con tipo 'envase'
        Empaque::create([
            'tipo' => 'envase',
            'precio' => $request->precio,
            'articulo_id' => $articulo->id,
        ]);

        return redirect()->route('envases.index')->with('success', 'Envase creado correctamente.');
    }

    // public function show($id)
    // {
    //     $envase = Empaque::with('articulo')->where('tipo', 'envase')->findOrFail($id);
    //     return view('cotizador.administracion.envases.show', compact('envase'));
    // }

    public function edit($id)
    {
        $envase = Empaque::with('articulo')->where('tipo', 'envase')->findOrFail($id);
        $unidades = UnidadMedida::pluck('nombre_unidad_de_medida', 'id');
        return view('cotizador.administracion.envases.edit', compact('envase', 'unidades'));
    }

    public function update(Request $request, $id)
    {
        $envase = Empaque::where('tipo', 'envase')->findOrFail($id);

        $rules = [
            'nombre' => 'required|string|max:255|unique:articulos,nombre,' . $envase->articulo->id,
            'precio' => 'required|numeric|min:0',
        ];
        $mensaje = ['nombre.unique' => 'El nombre del envase ya está en uso. Por favor, elige otro nombre.'];

        $request->validate($rules, $mensaje);

        // Actualizar el artículo asociado al envase
        $articulo = $envase->articulo;
        if ($articulo) {
            $articulo->update([
                'nombre' => $request->nombre,
                'estado' => $request->estado ?? 'activo',
                'tipo' => 'envase',
            ]);
        }

        // Actualizar el empaque
        $envase->update([
            'tipo' => 'envase',
            'precio' => $request->precio,
        ]);

        return redirect()->route('envases.index')->with('success', 'Envase actualizado correctamente.');
    }

    public function destroy($id)
    {
        $envase = Empaque::with('articulo')->where('tipo', 'envase')->find($id);

        if ($envase && $envase->articulo) {
            $articulo = $envase->articulo;
            if ($articulo->estado === 'inactivo') {
                return redirect()->back()->with('error', 'Envase inactivo. Para activarlo, por favor use la sección de editar.');
            }

            $articulo->update(['estado' => 'inactivo']);

            return redirect()->route('envases.index', ['estado' => 'inactivo'])
                ->with('success', 'Envase inactivado correctamente.');
        }

        return redirect()->route('envases.index')
            ->withErrors('Envase no encontrado.');
    }
}

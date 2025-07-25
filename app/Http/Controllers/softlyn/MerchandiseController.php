<?php

namespace App\Http\Controllers\softlyn;
use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\Articulo;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
        public function index()
    {
        $estado = request()->estado;

        $merchandise = Merchandise::with(['articulo.ultimaCompra'])->whereHas('articulo', function ($query) use ($estado) {
            if ($estado === 'inactivo') {
                $query->where('estado', 'inactivo');
            } else {
                $query->where('estado', 'activo'); // por defecto muestra los activos
            }
        })->orderBy('id', 'desc')->get();

        return view('cotizador.merchandise.index', compact('merchandise'));
    }

    public function create(){
        $merchandise = Merchandise::all();
        return view("cotizador.merchandise.create",compact("merchandise"));
    }
        public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:articulos,nombre',
            'precio' => 'required|numeric|min:0',
        ], [
            'nombre.unique' => 'Ya existe un artículo con ese nombre.',
        ]);

        // Crear artículo base
        $articulo = Articulo::create([
            'nombre' => $data['nombre'],
            'tipo' => 'merchandise',
            'stock' => 0,
            'estado' => 'activo',]);

        // Crear registro específico en la tabla merchandises
        Merchandise::create([
            'articulo_id' => $articulo->id,
            'precio' => $data['precio'],
        ]);

        return redirect()->route('merchandise.index')->with('success', 'Mercancía registrada correctamente.');
    }
        public function edit($id)
    {
        $merchandise = Merchandise::findOrFail($id);
        return view('cotizador.merchandise.edit', compact('merchandise'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:articulos,nombre,' . $id,
            'precio' => 'required|numeric|min:0',
            'estado' => 'nullable|in:activo,inactivo', 
        ], [
            'nombre.unique' => 'Ya existe un artículo con ese nombre.',
        ]);

        // Actualizar artículo base
        $articulo = Articulo::findOrFail($id);
        $articulo->update([
            'nombre' => $data['nombre'],
            'estado' => $validated['estado'] ?? 'activo', 
        ]);

        // Actualizar registro específico en la tabla merchandises
        $merchandise = Merchandise::where('articulo_id', $id)->first();
        if ($merchandise) {
            $merchandise->update([
                'precio' => $data['precio'],
            ]);
        }

        return redirect()->route('merchandise.index')->with('success', 'Mercancía actualizada correctamente.');
    }
    
            public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);

        if ($articulo->estado === 'inactivo') {
            // Ya está inactivo, muestra mensaje para activarlo desde editar
            return redirect()->route('merchandise.index', ['estado' => 'inactivo'])
                ->with('error', 'Este merchandise ya está inactivo. Puedes activarlo mediante la edición.');
        }

        // Si no está inactivo, lo marcamos como inactivo
        $articulo->update([
            'estado' => 'inactivo',
        ]);

        return redirect()->route('merchandise.index', ['estado' => 'inactivo'])->with('error', 'Mercancía marcada como inactiva.');
    }



}

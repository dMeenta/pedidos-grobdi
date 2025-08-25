<?php

namespace App\Http\Controllers\rutas\mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\CategoriaDoctor;
use Illuminate\Http\Request;

class CategoriaDoctorController extends Controller
{
    public function index(Request $request){
        $categoriadoctor = CategoriaDoctor::all();
        return view('rutas.mantenimiento.categoriadoctor.index',compact('categoriadoctor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prioridad' => 'required|integer',
            'monto_inicial' => 'required|numeric',
            'monto_final' => 'required|numeric',
        ]);

        CategoriaDoctor::create($request->only(['name', 'prioridad', 'monto_inicial', 'monto_final']));

        return redirect()->route('categoriadoctor.index')
            ->with('success', 'Categoría de doctor creada exitosamente.');
    }
    public function update(Request $request, $id)
    {

        $categoria = CategoriaDoctor::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'prioridad' => 'required|integer',
            'monto_inicial' => 'required|numeric',
            'monto_final' => 'required|numeric',
        ]);
        $categoria->update($request->only(['name', 'prioridad', 'monto_inicial', 'monto_final']));

        return redirect()->route('categoriadoctor.index')
                         ->with('success', 'Categoría de doctor actualizada exitosamente.');
    }
    public function destroy($id)
    {
        $categoria = CategoriaDoctor::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoriadoctor.index')
            ->with('success', 'Categoría de doctor eliminada exitosamente.');
    }
}

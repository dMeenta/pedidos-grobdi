<?php

namespace App\Http\Controllers\rutas\mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidad = Especialidad::paginate(25);
        return view('rutas.mantenimiento.especialidad.index',compact('especialidad'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rutas.mantenimiento.especialidad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        Especialidad::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        
        return redirect()->route('especialidad.index')
        ->with('success', 'Registrado completado Exitosamente');
        
    
    }
    public function edit(string $id)
    {
        $especialidad = Especialidad::find($id);
        return view('rutas.mantenimiento.especialidad.edit',compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $especialidad = Especialidad::find($id);
        $especialidad->name = $request->name;
        $especialidad->description = $request->description;
        $especialidad->save();
        return redirect()->route('especialidad.index')
        ->with('success', 'Especialidad actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $especialidad  = Especialidad::find($id);
        $especialidad->delete();

        return redirect()->route('especialidad.index')
        ->with('success', 'Especialidad eliminada exitosamente');
    }
}

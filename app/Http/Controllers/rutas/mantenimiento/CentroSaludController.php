<?php

namespace App\Http\Controllers\rutas\mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\CentroSalud;
use Illuminate\Http\Request;

class CentroSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centrosalud = CentroSalud::paginate(25);
        // dd($centrosalud);
        return view('rutas.mantenimiento.centrosalud.index',compact('centrosalud'));
    }
    public function show(){

    }
    public function buscar(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $centrosalud = CentroSalud::where('name', 'like', '%' . $request->query('term') . '%')
                ->get(['id','name']);
            return response()->json($centrosalud);
        }
    }
    public function create()
    {
        return view('rutas.mantenimiento.centrosalud.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'adress' => 'required|string|max:255',
        ]);
        CentroSalud::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'adress'=>$request->adress,
        ]);
        
        return redirect()->route('centrosalud.index')
        ->with('success', 'Registro completado Exitosamente');
        
    }


    public function edit(string $id)
    {
        $centrosalud = CentroSalud::find($id);
        return view('rutas.mantenimiento.centrosalud.edit',compact('centrosalud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $centrosalud = CentroSalud::find($id);
        $centrosalud->name = $request->name;
        $centrosalud->adress = $request->adress;
        $centrosalud->description = $request->description;
        $centrosalud->save();

        return redirect()->route('centrosalud.index')
        ->with('success', 'Centro de salud actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $centrosalud  = CentroSalud::find($id);
        $centrosalud->delete();

        return redirect()->route('centrosalud.index')
        ->with('success', 'Centro de salud eliminado exitosamente');
    }
}

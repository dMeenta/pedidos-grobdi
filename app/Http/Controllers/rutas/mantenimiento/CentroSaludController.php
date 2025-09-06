<?php

namespace App\Http\Controllers\rutas\mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\CentroSalud;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

class CentroSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centrosalud = CentroSalud::get();
        return view('rutas.mantenimiento.centrosalud.index',compact('centrosalud'));
    }
    public function show(){

    }
    public function buscar(Request $request)
    {
        // dd($request->all());
        Logger($request->all());
        if ($request->ajax()) {
            $centrosalud = CentroSalud::where('name', 'like', '%' . $request->query('term') . '%')
            ->where('state','like',1)
            ->get(['id','name as text']);
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
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        CentroSalud::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'adress'=>$request->adress,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
        ]);
        
        return redirect()->route('centrosalud.index')
        ->with('success', 'Registro completado Exitosamente');
        
    }
    public function creacionRapida(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:centrosalud,name'
        ]);

        $centro = CentroSalud::create([
            'name' => $validated['name']
        ]);

        return response()->json([
            'id' => $centro->id,
            'text' => $centro->name
        ]);
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
        $centrosalud->latitude = $request->latitude;
        $centrosalud->longitude = $request->longitude;
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
        if($centrosalud->state == 1){
            $centrosalud->state = 0;
            $msj = "inhabilitado";
        }else{
            $centrosalud->state = 1;
            $msj = "habilitado";
        }
        $centrosalud->save();

        return redirect()->back()
        ->with('success','Centro de salud '.$msj.' correctamente');
    }
}

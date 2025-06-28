<?php

namespace App\Http\Controllers\pedidos\laboratorio;

use App\Http\Controllers\Controller;
use App\Models\Bases;
use App\Models\Excipientes;
use App\Models\Ingredientes;
use App\Models\PresentacionFarmaceutica;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PresentacionFarmaceuticaController extends Controller
{
    public function index(){
        $presentaciones = PresentacionFarmaceutica::all();
        return view('pedidos.laboratorio.presentacionFarmaceutica.index',compact('presentaciones'));
    }
    public function edit($id)
    {
        $presentaciones = PresentacionFarmaceutica::all();
        $presentacionfarma = PresentacionFarmaceutica::find($id);
        return view('pedidos.laboratorio.presentacionFarmaceutica.index', compact('presentaciones', 'presentacionfarma'));
    }
    public function update(Request $request,$id){
        $presentaciones = PresentacionFarmaceutica::find($id);
        $presentaciones->name = $request->name;
        $presentaciones->save();

        return redirect()->route('presentacionfarmaceutica.index');
    }
    public function store(Request $request){
        $presentacionFar = new PresentacionFarmaceutica();
        $presentacionFar->name = $request->name;
        $presentacionFar->save();

        return redirect()->route('presentacionfarmaceutica.index');
    }
    public function destroy($id)
    {
        $presentacion = PresentacionFarmaceutica::find($id);
        $presentacion->delete();
        return redirect()->route('presentacionfarmaceutica.index');
    }
    public function listaringredientes($id){
        $ingredientes = Ingredientes::where('bases_id',$id)->get();

        return view('pedidos.laboratorio.presentacionFarmaceutica.ingrediente_index',compact('ingredientes'));
    }
    public function guardarbases(Request $request){
        $bases = new bases();
        $bases->presentacionfarmaceutica_id = $request->presentacion_id;
        $bases->name = $request->name;
        $bases->save();

        return redirect()->route('presentacionfarmaceutica.index');
    }
    public function guardaringredientes(Request $request){
        // dd($request->all());
        $ingredientes = new Ingredientes();
        $ingredientes->name = $request->name;
        $ingredientes->cantidad = $request->cantidad;
        $ingredientes->unidad_medida = $request->unidad_medida;
        $ingredientes->bases_id = $request->base_id;
        $ingredientes->save();
        return redirect()->route('ingredientes.index', $request->base_id);
    }
    public function actualizaringredientes(Request $request,$id){
        $ingrediente = Ingredientes::find($id);
        $ingrediente->cantidad = $request->cantidad;
        $ingrediente->save();
        
        return redirect()->back()->with('success','Ingrediente actualizado correctamente');
    }
    public function guardarexcipientes(Request $request){
        $excipientes = new Excipientes();
        $excipientes->name = $request->name;
        $excipientes->cantidad = $request->cantidad;
        $excipientes->unidad_medida = $request->unidad_medida;
        $excipientes->ingredientes_id = $request->ingrediente_id;
        $excipientes->save();
        return redirect()->back();
    }
    public function eliminarexcipientes($id){
        $excipientes = Excipientes::find($id);
        $excipientes->delete();

        return redirect()->back()->with('success','Excipiente eliminado correctamente                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ');
    }
}

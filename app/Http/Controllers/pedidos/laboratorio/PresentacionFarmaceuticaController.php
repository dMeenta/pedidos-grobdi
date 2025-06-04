<?php

namespace App\Http\Controllers\pedidos\laboratorio;

use App\Http\Controllers\Controller;
use App\Models\Bases;
use App\Models\Insumos;
use App\Models\PresentacionFarmaceutica;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PresentacionFarmaceuticaController extends Controller
{
    public function index(){
        $presentacionfarmaceutica = PresentacionFarmaceutica::all();
        return view('pedidos.laboratorio.presentacionFarmaceutica.index',compact('presentacionfarmaceutica'));
    }
    public function store(Request $request){
        $presentacionFar = new PresentacionFarmaceutica();
        $presentacionFar->name = $request->name;
        $presentacionFar->save();

        return redirect()->route('presentacionfarmaceutica.index');
    }
    public function listarinsumos($id){
        $insumos = Insumos::where('bases_id',$id)->get();

        return view('pedidos.laboratorio.presentacionFarmaceutica.insumo_index',compact('insumos'));
    }
    public function guardarbases(Request $request){
        $bases = new bases();
        $bases->presentacionfarmaceutica_id = $request->presentacion_id;
        $bases->name = $request->name;
        $bases->save();

        return redirect()->route('presentacionfarmaceutica.index');
    }
    public function guardarInsumos(Request $request){
        // dd($request->all());
        $insumos = new Insumos();
        $insumos->name = $request->name;
        $insumos->cantidad = $request->cantidad;
        $insumos->unidad_medida = $request->unidad_medida;
        $insumos->bases_id = $request->base_id;
        $insumos->save();
        return redirect()->route('insumos.index', $request->base_id);
    }
    public function guardarexcipientes(Request $request){
        dd($request->all());
    }
}

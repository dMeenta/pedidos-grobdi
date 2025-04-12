<?php

namespace App\Http\Controllers\rutas\enrutamiento;

use App\Http\Controllers\Controller;
use App\Models\Enrutamiento;
use App\Models\EnrutamientoLista;
use App\Models\Lista;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnrutamientoController extends Controller
{
    public function index(){
        $rutas = Enrutamiento::orderBy('fecha','desc')->get();
        return view('rutas.enrutamiento.index',compact('rutas'));
    }
    public function store(Request $request){
        // Validación
        // dd($request->all());
        $request->validate([
            'fecha_mes' => 'required',
        ]);
        // dd($request->fecha_mes.'-00');
        $zonas = Zone::whereIn('name',['norte','sur','centro'])->get();
        $existe_fecha = Enrutamiento::where('fecha',$request->fecha_mes.'-01')->first();
        if(!$existe_fecha){
            foreach ($zonas as $zona) {
                $enrutamiento = new Enrutamiento();
                $enrutamiento->fecha = $request->fecha_mes.'-01';
                $enrutamiento->zone_id = $zona->id;
                $enrutamiento->save();
                
            }
        }else{
            return redirect()->route('enrutamiento.index')->with('danger', 'Mes ya existente');
        }
        // Si la validación es correcta, guardar el item
        // Item::create($request->all());

        return redirect()->route('enrutamiento.index')->with('success', 'Mes añadido correctamente');
    }
    public function agregarLista($id){
        $enrutamiento = Enrutamiento::find($id);
        $listas = Lista::where('zone_id',$enrutamiento->zone_id)->get();
        $enrutamiento_lista = EnrutamientoLista::where('enrutamiento_id',$id)->get();
        $fechas_seleccionadas = [];
        if($enrutamiento_lista){
            foreach($enrutamiento_lista as $ruta_lista){
                $rangoInicio = Carbon::parse($ruta_lista->fecha_inicio);
                $rangoFin = Carbon::parse($ruta_lista->fecha_fin);
                while ($rangoInicio <= $rangoFin) {
                    // Agregar el día actual al arreglo
                    $fechas_seleccionadas[] = $rangoInicio->toDateString();
                
                    // Avanzar un día
                    $rangoInicio->addDay();
                }
            }
        }
        return view('rutas.enrutamiento.enrutamientolista', compact('listas','enrutamiento','fechas_seleccionadas'));
    }
    public function Enrutamientolistastore(Request $request){
        $request->validate([
            'fechas' => 'required',
            'lista_id' => 'required'
        ]);
        $rango = $request->input('fechas');
        $fechas = explode(" to ", $rango);
        $enrutamiento_lista = new EnrutamientoLista();
        $enrutamiento_lista->fecha_inicio = $fechas[0];
        $enrutamiento_lista->fecha_fin = $fechas[1];
        $enrutamiento_lista->lista_id = $request->lista_id;
        $enrutamiento_lista->enrutamiento_id = $request->enrutamiento_id;
        $enrutamiento_lista->save();

        return redirect()->route('enrutamiento.agregarlista',$request->enrutamiento_id);
        // dd($request->all());
    }
}

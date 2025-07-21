<?php

namespace App\Http\Controllers\rutas\enrutamiento;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Enrutamiento;
use App\Models\EnrutamientoLista;
use App\Models\EstadoVisita;
use App\Models\Lista;
use App\Models\VisitaDoctor;
use App\Models\Zone;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function Enrutamientolistastore(Request $request)
    {
        $request->validate([
            'fechas' => 'required',
            'lista_id' => 'required',
        ]);

        $lista = Lista::findOrFail($request->lista_id);
        $fechas = explode(" to ", $request->input('fechas'));
        $startDate = Carbon::parse($fechas[0]);
        $endDate = Carbon::parse($fechas[1]);
        $period = CarbonPeriod::create($startDate, $endDate);
        // Crear registro de EnrutamientoLista
        $enrutamiento_lista = new EnrutamientoLista();
        $enrutamiento_lista->fecha_inicio = $startDate->toDateString();
        $enrutamiento_lista->fecha_fin = $endDate->toDateString();
        $enrutamiento_lista->lista_id = $request->lista_id;
        $enrutamiento_lista->enrutamiento_id = $request->enrutamiento_id;
        $enrutamiento_lista->save();

        // Obtener todos los doctores asociados a los distritos
        foreach ($lista->distritos as $distrito) {
            $doctores = Doctor::where('distrito_id', $distrito->id)->get();

            foreach ($doctores as $doctor) {
                $turnos = [];

                // Obtener días y turnos
                if ($doctor->days) {
                    foreach ($doctor->days as $dia) {
                        $turnos[] = [
                            'dia' => $dia->name,
                            'turno' => $dia->pivot->turno,
                        ];
                    }
                }

                // Crear registro de VisitaDoctor
                $visita_doctor = new VisitaDoctor();
                $visita_doctor->doctor_id = $doctor->id;
                $visita_doctor->created_by = Auth::id();
                $visita_doctor->updated_by = Auth::id();
                $visita_doctor->enrutamientolista_id = $enrutamiento_lista->id;

                $fecha_asignada = false;

                // Buscar la primera fecha que coincida con un día de turno
                if (!empty($turnos)) {
                    $contador =0;
                    foreach ($period as $date) {
                        $nombre_dia = $date->translatedFormat('l');
                        ++$contador;
                        foreach ($turnos as $turno) {
                            if ($nombre_dia === $turno['dia']) {
                                $visita_doctor->fecha = $date->toDateString();
                                $visita_doctor->estado_visita_id = 2; // Asignado correctamente
                                $fecha_asignada = true;
                                break 2;
                            }
                        }
                    }
                }

                // Si no se asignó ninguna fecha
                if (!$fecha_asignada) {
                    $visita_doctor->estado_visita_id = 1; // Estado por defecto (sin turno)
                }

                $visita_doctor->save();
            }
        }

        return redirect()->route('enrutamiento.agregarlista', $request->enrutamiento_id);
    }

    public function DoctoresLista(Request $request,$id){
        $doctores = VisitaDoctor::where('enrutamientolista_id',$id)->get();
        $enruta = VisitaDoctor::where('enrutamientolista_id',$id)->first();
        $id = $enruta->enrutamientolista->enrutamiento->id;
        return view('rutas.enrutamiento.doctoreslista',compact('doctores','id'));
    }
    public function DoctoresListaUpdate(Request $request,$id){
        $visita_doctor = VisitaDoctor::find($id);
        $visita_doctor->fecha = $request->fecha;
        $visita_doctor->estado_visita_id = $visita_doctor->estado_visita_id == 3 ? 5 :2;
        $visita_doctor->save();
        return back()->with('success','Doctor Asignado exitosamente');
    }
    public function MisRutas(Request $request){
        $visitas = VisitaDoctor::with('doctor')->get();

        $eventos = $visitas->map(function ($visita) {
            return [
                'id' => $visita->doctor->id,
                'title' => $visita->doctor->name,
                'start' => $visita->fecha,
            ];
        });

        $doctoresConVisita = $visitas->pluck('doctor_id');
        $doctoresSinFecha = Doctor::whereNotIn('id', $doctoresConVisita)->get();

        return view('rutas.visita.index', compact('eventos', 'doctoresSinFecha'));
    }
    public function DetalleDoctorRutas(Request $request,$id){
        $doctor = Doctor::with(['distrito', 'especialidad', 'centroSalud'])->find($id);
        $visita = VisitaDoctor::where('doctor_id', $id)->first();
        $estados = EstadoVisita::whereNotIn('id',[1,2])->get();
        if (!$doctor) {
            return response()->json(['error' => 'Doctor no encontrado'], 404);
        }
        return response()->json([
            'doctor' => $doctor,
            'visita' => $visita,
            'estados' => $estados
        ]);
    }
    public function GuardarVisita(Request $request){
        $data = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'estado_visita_id' => 'required|exists:estado_visita,id',
            'observaciones' => 'nullable|string',
        ]);

        $visita = VisitaDoctor::updateOrCreate(
            ['doctor_id' => $data['doctor_id']],
            [
                'estado_visita_id' => $data['estado_visita_id'],
                'observaciones' => $data['observaciones'],
                'fecha_visita' => now(), // opcional si quieres setear la fecha actual
            ]
        );

        return response()->json(['success' => true, 'visita_id' => $visita->id]);
    }
}

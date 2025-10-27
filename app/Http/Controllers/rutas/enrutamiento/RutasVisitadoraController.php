<?php
namespace App\Http\Controllers\rutas\enrutamiento;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Distrito;
use App\Models\Doctor;
use App\Models\Enrutamiento;
use App\Models\EnrutamientoLista;
use App\Models\Especialidad;
use App\Models\VisitaDoctor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RutasVisitadoraController extends Controller
{
    public function ListarMisRutas()
    {
        $primerDiaMes = Carbon::now()->startOfMonth()->toDateString();
        $rutasMes = Enrutamiento::where('fecha', $primerDiaMes)
            ->whereIn('zone_id', Auth::user()->zones->pluck('id'))
            ->pluck('id');

        $listas = EnrutamientoLista::with('lista')
            ->whereIn('enrutamiento_id', $rutasMes)
            ->get();

        return view('rutas.visita.misrutas', compact('listas'));
    }
    public function listadoctores($id)
    {
        $rutames = EnrutamientoLista::findOrFail($id);
        $fecha_inicio = $rutames->fecha_inicio;
        $fecha_fin = $rutames->fecha_fin;
        $semana_ruta = $rutames;
        $dias = Day::all();
        $especialidades = Especialidad::all();
        $visitadoctores = VisitaDoctor::where('enrutamientolista_id', $id)
            ->with([
                'doctor.categoriadoctor',
                'doctor.centrosalud',
                'doctor.distrito',
                'estado_visita'
            ])
            ->get();

        $centrosSaludFiltro = $visitadoctores
            ->map(fn ($visita) => optional($visita->doctor->centrosalud)->name)
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $distritosFiltro = $visitadoctores
            ->map(fn ($visita) => optional($visita->doctor->distrito)->name)
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $distritos = Distrito::select('id', 'name')->where('provincia_id', 128)->orWhere('provincia_id', 67)->orderBy('name')->get();
        return view('rutas.visita.doctoresrutas', compact(
            'visitadoctores',
            'fecha_inicio',
            'fecha_fin',
            'semana_ruta',
            'especialidades',
            'distritos',
            'dias',
            'centrosSaludFiltro',
            'distritosFiltro'
        ));
    }
    public function asignar(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:visita_doctor,id',
            'fecha' => 'required|date',
            'turno' => ['required', Rule::in([0, 1, '0', '1'])],
        ]);

        $visita = VisitaDoctor::findOrFail($data['id']);
        $visita->fecha = $data['fecha'];
        $visita->turno = (int) $data['turno'];
        $visita->estado_visita_id = 2;
        $visita->updated_by = Auth::id();
        $visita->save();

        return response()->json(['success' => true, 'message' => 'Visita asignada correctamente.']);
    }

    public function reprogramar(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:visita_doctor,id',
            'fecha' => 'required|date',
            'turno' => ['required', Rule::in([0, 1, '0', '1'])],
        ]);

        $visita = VisitaDoctor::with('enrutamientolista')->findOrFail($data['id']);

        if ($visita->reprogramar) {
            return response('La visita ya fue programada anteriormente. Comunícate con tu supervisora.', 422);
        }

        $enrutamiento = $visita->enrutamientolista;
        if ($enrutamiento) {
            $fechaReprogramada = Carbon::parse($data['fecha'])->toDateString();
            $inicio = Carbon::parse($enrutamiento->fecha_inicio)->toDateString();
            $fin = Carbon::parse($enrutamiento->fecha_fin)->toDateString();

            if ($fechaReprogramada < $inicio || $fechaReprogramada > $fin) {
                return response('La nueva fecha debe estar dentro del rango de la lista seleccionada.', 422);
            }
        }

        DB::transaction(function () use ($visita, $data) {
            $visita->fecha = Carbon::parse($data['fecha'])->toDateString();
            $visita->turno = (int) $data['turno'];
            $visita->estado_visita_id = 5;
            $visita->reprogramar = 1;
            $visita->updated_by = Auth::id();
            $visita->save();
        });

        return response()->json(['success' => true, 'message' => 'Visita reprogramada correctamente.']);
    }
}

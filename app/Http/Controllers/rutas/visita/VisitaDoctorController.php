<?php

namespace App\Http\Controllers\rutas\visita;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\VisitaDoctor;
use Illuminate\Http\Request;

class VisitaDoctorController extends Controller
{
    public function aprobar($id)
    {
        $visita = VisitaDoctor::findOrFail($id);
        // Tu lógica para aprobar (ejemplo: cambiar un estado)
        $visita->estado_visita_id = 4;
        $visita->save();

        $doctor = Doctor::where('id', $visita->doctor_id)->first();
        $doctor->state = 1;
        $doctor->save();

        return response()->json(['success' => true]);
    }

    public function rechazar($id)
    {
        $visita = VisitaDoctor::findOrFail($id);
        // Tu lógica para rechazar
        $visita->estado_visita_id = 3;
        $visita->save();


        return response()->json(['success' => true]);
    }
}

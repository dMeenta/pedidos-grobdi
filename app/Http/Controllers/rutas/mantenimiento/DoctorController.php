<?php

namespace App\Http\Controllers\rutas\mantenimiento;

use App\Http\Controllers\Controller;
use App\Http\Requests\rutas\DoctorStoreRequest;
use App\Models\Day;
use App\Models\Distrito;
use App\Models\Distritos;
use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');  
        if ($search) {
            $doctores = Doctor::where('name', 'like', '%' . $search . '%')
                                ->orWhere('lastname', 'like', '%' . $search . '%')
                                ->paginate(25);  // Paginación, 25 por página
        } else {
            $doctores = Doctor::paginate(25);
        }
        $days = Day::all();
        return view('rutas.mantenimiento.doctor.index',compact('doctores','days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $distritos = Distrito::select('id','name')->where('provincia_id',128)->orWhere('provincia_id',67)->get();
        $especialidades = Especialidad::all();
        $dias = Day::all();
        return view('rutas.mantenimiento.doctor.create',compact('distritos','especialidades','dias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorStoreRequest $request)
    {
        // Obtener los días seleccionados
        $diasSeleccionados = $request->input('dias');
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->lastname = $request->lastname;
        $doctor->phone = $request->phone;
        $doctor->CMP = $request->cmp;
        $doctor->distrito_id = $request->distrito_id;
        $doctor->centrosalud_id = $request->centrosalud_id;
        $doctor->especialidad_id = $request->especialidad_id;
        $doctor->birthdate =  date('Y-m-d' , strtotime($request->birthdate));
        $doctor->categoria_medico = $request->categoria_medico;
        $doctor->tipo_medico = $request->tipo_medico;
        $doctor->asignado_consultorio = $request->asignado_consultorio;
        $doctor->songs = $request->songs;
        $doctor->name_secretariat = $request->name_secretariat;
        $doctor->phone_secretariat = $request->phone_secretariat;
        $doctor->observations = $request->observations;
        $doctor->user_id = Auth::user()->id;
        // dd($doctor);
        $doctor->save();
        // Crear un arreglo con los turnos seleccionados para cada día
        $doctorday = [];
        foreach ($diasSeleccionados as $dia) {
            array_push($doctorday, ['doctor_id' => $doctor->id,'day_id' => $dia,'turno'=> $request->input("turno_$dia")]) ;
            // dd($doctor_day);
        }
        $doctor->days()->attach($doctorday);
        return redirect()->route('doctor.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);
        if($doctor->state == 1){
            $doctor->state = 0;
            $msj = "inhabilitado";
        }else{
            $doctor->state = 1;
            $msj = "habilitado";
        }
        $doctor->save();
        return redirect()->route('doctor.index')->with('success','doctor '.$msj.' correctamente');
    }
}

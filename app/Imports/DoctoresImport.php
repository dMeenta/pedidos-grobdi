<?php

namespace App\Imports;

use App\Models\CentroSalud;
use App\Models\Distrito;
use App\Models\Doctor;
use App\Models\Especialidad;
use Carbon\Carbon;
use FontLib\Table\Type\name;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use function PHPUnit\Framework\isString;

class DoctoresImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public $data;
    public $key;
    public function startRow(): int
    {
        return 2; // Empezamos a leer a partir de la fila 2 (después de las dos filas de cabecera)
    }
    public function collection(Collection $collection)
    {
        // $mensaje = "";
        $contador = 0;
        $contadorexist = 0;
        $contadorerror = 0;
        $key = "danger";
        $acum = [];
        foreach ($collection as $value) {
            if($value[12]){
                $doctorexist = Doctor::where('CMP',$value[3])->first();
                if(!$doctorexist){
                    $doctor = new Doctor();
                    $centrosalud = CentroSalud::where('name',$value[12])->first();
                    $especialidad = Especialidad::where('name',$value[9])->first();
                    if($centrosalud){
                        $doctor->centrosalud_id = $centrosalud->id;
                    }else{
                        $centrosalud = new CentroSalud();
                        $centrosalud->name = $value[12];
                        $centrosalud->save();
                        //una vez creado el centro de salud nuevo ingresamos su id al doctor
                        $doctor->centrosalud_id = $centrosalud->id;
                    }
                    if($especialidad){
                        $doctor->especialidad_id = $especialidad->id;
                    }else{
                        $especialidad = new Especialidad();
                        $especialidad->name = $value[9];
                        $especialidad->save();
                        //una vez creado la especialidad nueva ingresamos su id al doctor
                        $doctor->especialidad_id = $especialidad->id;
                    }
                    // $namecompleted = explode(" ",string: $value[2]);
                    // $nombre = "";
                    // $apellido = "";
                    // foreach ($namecompleted as $index => $separador) {
                    //     if(count($namecompleted) < 4){
                    //         if($index == 0){
                    //             $nombre = $separador;
                    //         }else{
                    //             $apellido = $apellido.$separador." ";
                    //         }
                    //     }else{
                    //         if($index == 0 || $index == 1){
    
                    //             $nombre = $nombre.$separador." ";
                    //         }else{
                    //             $apellido = $apellido.$separador." ";
                    //         }
                    //     }
                    // }
                    $doctor->name = $value[2];
                    $doctor->CMP = $value[3];
                    $doctor->phone = $value[4];
                    // if(!isString($value[6])){
                    //     $doctor->birthdate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[6]))->format('Y-m-d');
                    // }
                    $doctor->name_secretariat = $value[7];
                    $doctor->observations = $value[8];
                    $namedistrict = explode("-",$value[11]);
                    if($namedistrict[0] == "CERCADO DE LIMA"){
                        $namedistrict[0] = "LIMA";
                    }
                    if($namedistrict[0] == "SURCO"){
                        $namedistrict[0] = "SANTIAGO DE SURCO";
                    }
                    if($namedistrict[0] == "ATE "){
                        $namedistrict[0] = "ATE";
                    }
                    if($namedistrict[0] == "MAGDALENA"){
                        $namedistrict[0] = "MAGDALENA DEL MAR";
                    }
                    if($namedistrict[0] == "BREÃ‘A"){
                        $namedistrict[0] = "BREÑA";
                    }
                    if($namedistrict[0] == "BREÃ‘A "){
                        $namedistrict[0] = "BREÑA";
                    }
                    if($namedistrict[0] == "ZARATE"){
                        $namedistrict[0] = "SAN JUAN DE LURIGANCHO";
                    }
                    $distrito = Distrito::where('provincia_id',128)->orWhere('provincia_id',67)->get();
                    foreach ($distrito as $distric) {
                        if($distric->name == $namedistrict[0]){
                            $doctor->distrito_id = $distric->id;
                        }
                    }
                    !$value[15]? $categoria = "Visitador":$categoria= $value[15];
                    $doctor->categoria_medico = $categoria;
                    !$value[16]? $tipomedico = "En Proceso":$tipomedico= $value[16];
                    $doctor->tipo_medico = $tipomedico;
                    $doctor->asignado_consultorio = 0;
                    $doctor->user_id = Auth::user()->id;
                    $doctor->categoriadoctor_id = 5;
                    $doctor->save();
                    // LUNES
                    if (isset($value[21]) && !empty($value[21])) {
                        $doctor->days()->attach(1, ['turno' => strtolower($value[21]) == 'm' ? 0 : 1]);
                    }

                    // MARTES
                    if (isset($value[22]) && !empty($value[22])) {
                        $doctor->days()->attach(2, ['turno' => strtolower($value[22]) == 'm' ? 0 : 1]);
                    }

                    // MIÉRCOLES
                    if (isset($value[23]) && !empty($value[23])) {
                        $doctor->days()->attach(3, ['turno' => strtolower($value[23]) == 'm' ? 0 : 1]);
                    }

                    // JUEVES
                    if (isset($value[24]) && !empty($value[24])) {
                        $doctor->days()->attach(4, ['turno' => strtolower($value[24]) == 'm' ? 0 : 1]);
                    }
                    // VIERNES
                    if (isset($value[25]) && !empty($value[25])) {
                        $doctor->days()->attach(5, ['turno' => strtolower($value[25]) == 'm' ? 0 : 1]);
                    }
                    $key = "success";
                    ++$contador;
                }else{
                    array_push($acum, $value[3]);
                    ++$contadorexist;
                }


            }
            else{
                ++$contadorerror; 
            }
        }
        $this->data = "Doctores registrados: ".$contador." Existentes: ".$contadorexist. " No registrados por no tener centro de salud: ".$contadorerror;
        $this->key = $key;
    }
}

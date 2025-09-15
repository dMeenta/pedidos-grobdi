<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Especialidad;
use App\Models\CentroSalud;
use App\Models\CategoriaDoctor;
use App\Models\Distrito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primero crear algunas especialidades si no existen
        $especialidades = [
            ['name' => 'Medicina Interna', 'description' => 'Especialidad médica que se dedica a la atención integral del adulto'],
            ['name' => 'Cardiología', 'description' => 'Especialidad médica que se ocupa de las enfermedades del corazón'],
            ['name' => 'Pediatría', 'description' => 'Especialidad médica que estudia al niño y sus enfermedades'],
            ['name' => 'Ginecología', 'description' => 'Especialidad médica dedicada al cuidado del sistema reproductor femenino'],
            ['name' => 'Traumatología', 'description' => 'Especialidad médica que se dedica al estudio del aparato locomotor'],
            ['name' => 'Dermatología', 'description' => 'Especialidad médica dedicada al estudio de la piel'],
            ['name' => 'Neurología', 'description' => 'Especialidad médica que trata trastornos del sistema nervioso'],
            ['name' => 'Oftalmología', 'description' => 'Especialidad médica que estudia las enfermedades de los ojos'],
        ];

        foreach ($especialidades as $esp) {
            Especialidad::firstOrCreate(['name' => $esp['name']], $esp);
        }

        // Crear algunos centros de salud si no existen
        $centrosSalud = [
            ['name' => 'Hospital Nacional Dos de Mayo', 'description' => 'Hospital público nacional', 'adress' => 'Av. Grau cuadra 13, Cercado de Lima', 'state' => 1],
            ['name' => 'Hospital Nacional Arzobispo Loayza', 'description' => 'Hospital público nacional', 'adress' => 'Av. Alfonso Ugarte 848, Cercado de Lima', 'state' => 1],
            ['name' => 'Hospital Guillermo Almenara Irigoyen', 'description' => 'Hospital de EsSalud', 'adress' => 'Av. Grau 800, La Victoria', 'state' => 1],
            ['name' => 'Clínica San Felipe', 'description' => 'Clínica privada', 'adress' => 'Av. Gregorio Escobedo 650, Jesús María', 'state' => 1],
            ['name' => 'Centro de Salud San Martín de Porres', 'description' => 'Centro de salud público', 'adress' => 'Jr. Canta 456, San Martín de Porres', 'state' => 1],
            ['name' => 'Hospital María Auxiliadora', 'description' => 'Hospital público', 'adress' => 'Av. Miguel Iglesias 968, San Juan de Miraflores', 'state' => 1],
        ];

        foreach ($centrosSalud as $centro) {
            CentroSalud::firstOrCreate(['name' => $centro['name']], $centro);
        }

        // Obtener los primeros registros para usar en los doctores
        $especialidades = Especialidad::limit(8)->get();
        $centrosSalud = CentroSalud::limit(6)->get();
        $categoriasDoctor = CategoriaDoctor::limit(5)->get();
        $distritos = Distrito::where('provincia_id', 128)->orWhere('provincia_id', 67)->limit(20)->get(); // Lima y Callao

        // Datos de doctores realistas
        $doctoresData = [
            [
                'name' => 'Carlos Alberto',
                'first_lastname' => 'García',
                'second_lastname' => 'Mendoza',
                'name_softlynn' => 'Dr. García Mendoza',
                'CMP' => '12345',
                'phone' => '987654321',
                'type_document' => 'DNI',
                'number_document' => '12345678',
                'categoria_medico' => 'empresa',
                'tipo_medico' => 'Prescriptor',
            ],
            [
                'name' => 'María Elena',
                'first_lastname' => 'Rodriguez',
                'second_lastname' => 'Silva',
                'name_softlynn' => 'Dra. María Rodriguez',
                'CMP' => '12346',
                'phone' => '987654322',
                'type_document' => 'DNI',
                'number_document' => '12345679',
                'categoria_medico' => 'visitador',
                'tipo_medico' => 'Comprador',
            ],
            [
                'name' => 'José Luis',
                'first_lastname' => 'Fernández',
                'second_lastname' => 'Paredes',
                'name_softlynn' => 'Dr. José Fernández',
                'CMP' => '12347',
                'phone' => '987654323',
                'type_document' => 'DNI',
                'number_document' => '12345680',
                'categoria_medico' => 'empresa',
                'tipo_medico' => 'Prescriptor',
            ],
            [
                'name' => 'Ana Patricia',
                'first_lastname' => 'López',
                'second_lastname' => 'Vargas',
                'name_softlynn' => 'Dra. Ana López',
                'CMP' => '12348',
                'phone' => '987654324',
                'type_document' => 'DNI',
                'number_document' => '12345681',
                'categoria_medico' => 'visitador',
                'tipo_medico' => 'En Proceso',
            ],
            [
                'name' => 'Roberto',
                'first_lastname' => 'Chávez',
                'second_lastname' => 'Morales',
                'name_softlynn' => 'Dr. Roberto Chávez',
                'CMP' => '12349',
                'phone' => '987654325',
                'type_document' => 'DNI',
                'number_document' => '12345682',
                'categoria_medico' => 'empresa',
                'tipo_medico' => 'Prescriptor',
            ],
            [
                'name' => 'Lucía Carmen',
                'first_lastname' => 'Herrera',
                'second_lastname' => 'Quispe',
                'name_softlynn' => 'Dra. Lucía Herrera',
                'CMP' => '12350',
                'phone' => '987654326',
                'type_document' => 'DNI',
                'number_document' => '12345683',
                'categoria_medico' => 'visitador',
                'tipo_medico' => 'Comprador',
            ],
            [
                'name' => 'Miguel Angel',
                'first_lastname' => 'Castillo',
                'second_lastname' => 'Ramos',
                'name_softlynn' => 'Dr. Miguel Castillo',
                'CMP' => '12351',
                'phone' => '987654327',
                'type_document' => 'DNI',
                'number_document' => '12345684',
                'categoria_medico' => 'empresa',
                'tipo_medico' => 'Prescriptor',
            ],
            [
                'name' => 'Carmen Rosa',
                'first_lastname' => 'Torres',
                'second_lastname' => 'Flores',
                'name_softlynn' => 'Dra. Carmen Torres',
                'CMP' => '12352',
                'phone' => '987654328',
                'type_document' => 'DNI',
                'number_document' => '12345685',
                'categoria_medico' => 'visitador',
                'tipo_medico' => 'En Proceso',
            ],
            [
                'name' => 'Fernando',
                'first_lastname' => 'Vega',
                'second_lastname' => 'Salazar',
                'name_softlynn' => 'Dr. Fernando Vega',
                'CMP' => '12353',
                'phone' => '987654329',
                'type_document' => 'DNI',
                'number_document' => '12345686',
                'categoria_medico' => 'empresa',
                'tipo_medico' => 'Comprador',
            ],
            [
                'name' => 'Sofía Isabel',
                'first_lastname' => 'Medina',
                'second_lastname' => 'Cruz',
                'name_softlynn' => 'Dra. Sofía Medina',
                'CMP' => '12354',
                'phone' => '987654330',
                'type_document' => 'DNI',
                'number_document' => '12345687',
                'categoria_medico' => 'visitador',
                'tipo_medico' => 'Prescriptor',
            ],
            [
                'name' => 'Alejandro',
                'first_lastname' => 'Jiménez',
                'second_lastname' => 'Navarro',
                'name_softlynn' => 'Dr. Alejandro Jiménez',
                'CMP' => '12355',
                'phone' => '987654331',
                'type_document' => 'DNI',
                'number_document' => '12345688',
                'categoria_medico' => 'empresa',
                'tipo_medico' => 'En Proceso',
            ],
            [
                'name' => 'Paola Andrea',
                'first_lastname' => 'Ruiz',
                'second_lastname' => 'Aguilar',
                'name_softlynn' => 'Dra. Paola Ruiz',
                'CMP' => '12356',
                'phone' => '987654332',
                'type_document' => 'DNI',
                'number_document' => '12345689',
                'categoria_medico' => 'visitador',
                'tipo_medico' => 'Comprador',
            ],
        ];

        foreach ($doctoresData as $index => $doctorData) {
            // Solo crear si no existe el doctor con ese CMP
            if (!Doctor::where('CMP', $doctorData['CMP'])->exists()) {
                $doctor = new Doctor();
                $doctor->name = $doctorData['name'];
                $doctor->first_lastname = $doctorData['first_lastname'];
                $doctor->second_lastname = $doctorData['second_lastname'];
                $doctor->name_softlynn = $doctorData['name_softlynn'];
                $doctor->CMP = $doctorData['CMP'];
                $doctor->phone = $doctorData['phone'];
                $doctor->type_document = $doctorData['type_document'];
                $doctor->number_document = $doctorData['number_document'];
                $doctor->categoria_medico = $doctorData['categoria_medico'];
                $doctor->tipo_medico = $doctorData['tipo_medico'];
                
                // Asignar datos relacionados de forma cíclica
                $doctor->especialidad_id = $especialidades[$index % $especialidades->count()]->id;
                $doctor->centrosalud_id = $centrosSalud[$index % $centrosSalud->count()]->id;
                $doctor->categoriadoctor_id = $categoriasDoctor[$index % $categoriasDoctor->count()]->id;
                
                if ($distritos->count() > 0) {
                    $doctor->distrito_id = $distritos[$index % $distritos->count()]->id;
                }
                
                // Otros campos con valores por defecto
                $doctor->birthdate = now()->subYears(rand(30, 60))->format('Y-m-d');
                $doctor->asignado_consultorio = rand(0, 1);
                $doctor->songs = rand(0, 1);
                $doctor->recovery = rand(0, 1);
                $doctor->state = 1; // Activo
                $doctor->aprobacion_supervisora = 1;
                
                // Algunos doctores con secretaria
                if ($index % 3 == 0) {
                    $doctor->name_secretariat = 'Secretaria ' . ($index + 1);
                    $doctor->phone_secretariat = '987654' . sprintf('%03d', 400 + $index);
                }
                
                $doctor->observations = 'Doctor creado por seeder para pruebas';
                
                $doctor->save();
            }
        }
        
        $this->command->info('✅ Se han creado ' . count($doctoresData) . ' doctores de prueba');
    }
}

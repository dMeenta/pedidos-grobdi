<?php

use App\Models\Doctor;
use App\Models\Pedidos;
use App\Models\Especialidad;
use App\Models\CentroSalud;
use App\Models\CategoriaDoctor;
use App\Models\User;
use App\Models\Zone;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('doctor can be created with required data', function () {
    $especialidad = Especialidad::create(['name' => 'Medicina General']);
    $centroSalud = CentroSalud::create(['name' => 'Hospital Test', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'A',
        'prioridad' => 1,
        'monto_inicial' => 5.00,
        'monto_final' => 10.00
    ]);

    $doctor = Doctor::create([
        'name' => 'Juan',
        'first_lastname' => 'Pérez',
        'second_lastname' => 'Gómez',
        'name_softlynn' => 'Dr. Juan Pérez',
        'CMP' => '123456',
        'phone' => '987654321',
        'categoria_medico' => 'empresa',
        'tipo_medico' => 'Prescriptor',
        'asignado_consultorio' => true,
        'songs' => false,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    expect($doctor)->toBeInstanceOf(Doctor::class);
    expect($doctor->name)->toBe('Juan');
    expect($doctor->name_softlynn)->toBe('Dr. Juan Pérez');
    expect($doctor->CMP)->toBe('123456');
    expect($doctor->state)->toBe(1);
    
    $this->assertDatabaseHas('doctor', [
        'name' => 'Juan',
        'name_softlynn' => 'Dr. Juan Pérez'
    ]);
});

test('doctor has correct fillable attributes', function () {
    $fillable = (new Doctor())->getFillable();
    
    $expectedFillable = [
        'name',
        'first_lastname',
        'second_lastname',
        'name_softlynn',
        'CMP',
        'phone',
        'categoria_medico',
        'tipo_medico',
        'asignado_consultorio',
        'songs',
        'recovery',
        'state',
        'aprobacion_supervisora',
        'especialidad_id',
        'centrosalud_id',
        'categoriadoctor_id',
    ];

    foreach ($expectedFillable as $field) {
        expect($fillable)->toContain($field);
    }
});

test('doctor belongs to especialidad', function () {
    $especialidad = Especialidad::create(['name' => 'Cardiología']);
    $centroSalud = CentroSalud::create(['name' => 'Clínica Test', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'B',
        'prioridad' => 2,
        'monto_inicial' => 8.00,
        'monto_final' => 15.00
    ]);

    $doctor = Doctor::create([
        'name' => 'Ana',
        'first_lastname' => 'López',
        'second_lastname' => 'Torres',
        'name_softlynn' => 'Dra. Ana López',
        'CMP' => '654321',
        'phone' => '987654322',
        'categoria_medico' => 'visitador',
        'tipo_medico' => 'Comprador',
        'asignado_consultorio' => false,
        'songs' => true,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    expect($doctor->especialidad)->toBeInstanceOf(Especialidad::class);
    expect($doctor->especialidad->name)->toBe('Cardiología');
});

test('doctor belongs to centro salud', function () {
    $especialidad = Especialidad::create(['name' => 'Pediatría']);
    $centroSalud = CentroSalud::create(['name' => 'Hospital Nacional', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'C',
        'prioridad' => 3,
        'monto_inicial' => 12.00,
        'monto_final' => 20.00
    ]);

    $doctor = Doctor::create([
        'name' => 'Pedro',
        'first_lastname' => 'Rodríguez',
        'second_lastname' => 'Vega',
        'name_softlynn' => 'Dr. Pedro Rodríguez',
        'CMP' => '789123',
        'phone' => '987654323',
        'categoria_medico' => 'empresa',
        'tipo_medico' => 'Prescriptor',
        'asignado_consultorio' => true,
        'songs' => false,
        'recovery' => true,
        'state' => 1,
        'aprobacion_supervisora' => false,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    expect($doctor->centrosalud)->toBeInstanceOf(CentroSalud::class);
    expect($doctor->centrosalud->name)->toBe('Hospital Nacional');
});

test('doctor belongs to categoria doctor', function () {
    $especialidad = Especialidad::create(['name' => 'Ginecología']);
    $centroSalud = CentroSalud::create(['name' => 'Clínica Privada', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'Premium',
        'prioridad' => 1,
        'monto_inicial' => 20.00,
        'monto_final' => 30.00
    ]);

    $doctor = Doctor::create([
        'name' => 'Carmen',
        'first_lastname' => 'Martínez',
        'second_lastname' => 'Huamán',
        'name_softlynn' => 'Dra. Carmen Martínez',
        'CMP' => '456789',
        'phone' => '987654324',
        'categoria_medico' => 'visitador',
        'tipo_medico' => 'Comprador',
        'asignado_consultorio' => false,
        'songs' => true,
        'recovery' => true,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    expect($doctor->categoriadoctor)->toBeInstanceOf(CategoriaDoctor::class);
    expect($doctor->categoriadoctor->name)->toBe('Premium');
    expect($doctor->categoriadoctor->monto_inicial)->toBe(20.00);
});

test('doctor can have pedidos relationship', function () {
    // Crear datos necesarios
    $user = User::factory()->create();
    $zone = Zone::factory()->create();
    
    $especialidad = Especialidad::create(['name' => 'Traumatología']);
    $centroSalud = CentroSalud::create(['name' => 'Hospital Regional', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'Standard',
        'prioridad' => 2,
        'monto_inicial' => 10.00,
        'monto_final' => 18.00
    ]);

    $doctor = Doctor::create([
        'name' => 'Roberto',
        'first_lastname' => 'Silva',
        'second_lastname' => 'Campos',
        'name_softlynn' => 'Dr. Roberto Silva',
        'CMP' => '321654',
        'phone' => '987654325',
        'categoria_medico' => 'empresa',
        'tipo_medico' => 'Prescriptor',
        'asignado_consultorio' => true,
        'songs' => false,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    // Crear pedidos asociados al doctor
    Pedidos::create([
        'orderId' => 'DOCTOR-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Doctor Test',
        'doctorName' => 'Dr. Roberto Silva',
        'id_doctor' => $doctor->id,
        'address' => 'Dirección Doctor Test',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 300.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    Pedidos::create([
        'orderId' => 'DOCTOR-002',
        'nroOrder' => 2,
        'customerName' => 'Cliente Doctor Test 2',
        'doctorName' => 'Dr. Roberto Silva',
        'id_doctor' => $doctor->id,
        'address' => 'Dirección Doctor Test 2',
        'reference' => 'Referencia Test 2',
        'district' => 'Callao',
        'prize' => 350.00,
        'paymentStatus' => 'PAGADO',
        'deliveryDate' => now()->addDays(2)->format('Y-m-d'),
        'deliveryStatus' => 'Entregado',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    // Verificar relación
    expect($doctor->pedidos)->toHaveCount(2);
    expect($doctor->pedidos->first())->toBeInstanceOf(Pedidos::class);
    expect($doctor->pedidos->pluck('orderId')->toArray())->toContain('DOCTOR-001', 'DOCTOR-002');
});

test('doctor search by name_softlynn works correctly', function () {
    $especialidad = Especialidad::create(['name' => 'Neurología']);
    $centroSalud = CentroSalud::create(['name' => 'Instituto Neurológico', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'Especialista',
        'prioridad' => 1,
        'monto_inicial' => 25.00,
        'monto_final' => 40.00
    ]);

    // Crear varios doctores
    $doctor1 = Doctor::create([
        'name' => 'Luis',
        'first_lastname' => 'García',
        'second_lastname' => 'Morales',
        'name_softlynn' => 'Dr. Luis García - Neurocirujano',
        'CMP' => '111222',
        'phone' => '987654326',
        'categoria_medico' => 'empresa',
        'tipo_medico' => 'Prescriptor',
        'asignado_consultorio' => true,
        'songs' => false,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    $doctor2 = Doctor::create([
        'name' => 'María',
        'first_lastname' => 'García',
        'second_lastname' => 'López',
        'name_softlynn' => 'Dra. María García - Neuróloga',
        'CMP' => '333444',
        'phone' => '987654327',
        'categoria_medico' => 'visitador',
        'tipo_medico' => 'Comprador',
        'asignado_consultorio' => false,
        'songs' => true,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $especialidad->id,
        'centrosalud_id' => $centroSalud->id,
        'categoriadoctor_id' => $categoria->id,
    ]);

    // Buscar por García
    $results = Doctor::where('name_softlynn', 'LIKE', '%García%')->get();
    
    expect($results)->toHaveCount(2);
    expect($results->pluck('name_softlynn')->toArray())->toContain(
        'Dr. Luis García - Neurocirujano',
        'Dra. María García - Neuróloga'
    );
});

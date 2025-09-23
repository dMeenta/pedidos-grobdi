<?php

use App\Models\Pedidos;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Zone;
use App\Models\Especialidad;
use App\Models\CentroSalud;
use App\Models\CategoriaDoctor;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('pedidos can be created with basic data', function () {
    // Crear rol necesario
    $role = \App\Models\Role::create([
        'name' => 'test-role',
        'description' => 'Test Role'
    ]);
    
    // Crear datos de prueba necesarios manualmente
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'role_id' => $role->id,
        'email_verified_at' => now()
    ]);
    
    $zone = Zone::create([
        'name' => 'Test Zone',
        'state' => 1
    ]);

    $pedidoData = [
        'orderId' => 'TEST-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Test',
        'customerNumber' => '987654321',
        'doctorName' => 'Dr. Test',
        'address' => 'Dirección Test 123',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 100.50,
        'paymentStatus' => 'PENDIENTE',
        'productionStatus' => false,
        'accountingStatus' => false,
        'turno' => 0,
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ];

    $pedido = Pedidos::create($pedidoData);

    expect($pedido)->toBeInstanceOf(Pedidos::class);
    expect($pedido->orderId)->toBe('TEST-001');
    expect($pedido->doctorName)->toBe('Dr. Test');
    expect($pedido->prize)->toBe(100.50);
    
    $this->assertDatabaseHas('pedidos', ['orderId' => 'TEST-001']);
});

test('pedidos can be associated with doctor', function () {
    // Crear datos necesarios manualmente
    $user = User::create([
        'name' => 'Test User 2',
        'email' => 'test2@example.com',
        'password' => 'password',
        'email_verified_at' => now()
    ]);
    
    $zone = Zone::create([
        'name' => 'Test Zone 2',
        'state' => 1
    ]);
    
    // Crear especialidad, centro de salud y categoría doctor
    $especialidad = Especialidad::create(['name' => 'Medicina General']);
    $centroSalud = CentroSalud::create(['name' => 'Hospital Test', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'A',
        'prioridad' => 1,
        'monto_inicial' => 5.00,
        'monto_final' => 10.00
    ]);

    // Crear doctor
    $doctor = Doctor::create([
        'name' => 'Carlos',
        'first_lastname' => 'García',
        'second_lastname' => 'Mendoza',
        'name_softlynn' => 'Dr. García Test',
        'CMP' => '12345',
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

    // Crear pedido con doctor asociado
    $pedido = Pedidos::create([
        'orderId' => 'TEST-002',
        'nroOrder' => 1,
        'customerName' => 'Cliente Test 2',
        'doctorName' => 'Dr. García Test',
        'id_doctor' => $doctor->id,
        'address' => 'Dirección Test 456',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 150.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    // Verificar relación
    expect($pedido->doctor)->toBeInstanceOf(Doctor::class);
    expect($pedido->doctor->id)->toBe($doctor->id);
    expect($pedido->doctor->name_softlynn)->toBe('Dr. García Test');
});

test('doctor can have multiple pedidos', function () {
    // Crear datos necesarios manualmente
    $user = User::create([
        'name' => 'Test User 3',
        'email' => 'test3@example.com',
        'password' => 'password',
        'email_verified_at' => now()
    ]);
    
    $zone = Zone::create([
        'name' => 'Test Zone 3',
        'state' => 1
    ]);
    
    $especialidad = Especialidad::create(['name' => 'Cardiología']);
    $centroSalud = CentroSalud::create(['name' => 'Clínica Test', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'AA',
        'prioridad' => 2,
        'monto_inicial' => 10.00,
        'monto_final' => 15.00
    ]);

    $doctor = Doctor::create([
        'name' => 'María',
        'first_lastname' => 'López',
        'second_lastname' => 'Silva',
        'name_softlynn' => 'Dra. María López',
        'CMP' => '54321',
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

    // Crear múltiples pedidos para el mismo doctor
    $pedido1 = Pedidos::create([
        'orderId' => 'TEST-003',
        'nroOrder' => 1,
        'customerName' => 'Cliente Test 3',
        'doctorName' => 'Dra. María López',
        'id_doctor' => $doctor->id,
        'address' => 'Dirección Test 789',
        'reference' => 'Referencia Test',
        'district' => 'Miraflores',
        'prize' => 200.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    $pedido2 = Pedidos::create([
        'orderId' => 'TEST-004',
        'nroOrder' => 2,
        'customerName' => 'Cliente Test 4',
        'doctorName' => 'Dra. María López',
        'id_doctor' => $doctor->id,
        'address' => 'Dirección Test 101',
        'reference' => 'Referencia Test',
        'district' => 'San Isidro',
        'prize' => 250.00,
        'paymentStatus' => 'PAGADO',
        'deliveryDate' => now()->addDays(2)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    // Verificar que el doctor tiene múltiples pedidos
    expect($doctor->pedidos)->toHaveCount(2);
    expect($doctor->pedidos->contains($pedido1))->toBeTrue();
    expect($doctor->pedidos->contains($pedido2))->toBeTrue();
});

test('pedidos delivery date is cast to carbon', function () {
    $user = User::create([
        'name' => 'Test User 4',
        'email' => 'test4@example.com',
        'password' => 'password',
        'email_verified_at' => now()
    ]);
    
    $zone = Zone::create([
        'name' => 'Test Zone 4',
        'state' => 1
    ]);

    $pedido = Pedidos::create([
        'orderId' => 'TEST-005',
        'nroOrder' => 1,
        'customerName' => 'Cliente Test 5',
        'doctorName' => 'Dr. Test Date',
        'address' => 'Dirección Test',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 100.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => '2025-12-25',
        'deliveryStatus' => 'Pendiente',
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    expect($pedido->deliveryDate)->toBeInstanceOf(\Carbon\Carbon::class);
    expect((string) $pedido->deliveryDate)->toContain('2025-12-25');
});

test('pedidos has correct fillable attributes', function () {
    $fillable = (new Pedidos())->getFillable();
    
    $expectedFillable = [
        'orderId',
        'nroOrder',
        'customerName',
        'customerNumber',
        'doctorName',
        'id_doctor',
        'address',
        'turno',
        'reference',
        'district',
        'prize',
        'paymentStatus',
        'productionStatus',
        'accountingStatus',
        'deliveryDate',
        'detailMotorizado',
        'user_id',
        'zone_id',
        'voucher',
        'receta',
        'observacion_laboratorio',
        'fecha_reprogramacion',
        'last_data_update',
    ];

    foreach ($expectedFillable as $field) {
        expect($fillable)->toContain($field);
    }
});

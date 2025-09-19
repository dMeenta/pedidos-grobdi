<?php

use App\Models\Doctor;
use App\Models\Pedidos;
use App\Models\User;
use App\Models\Zone;
use App\Models\Role;
use App\Models\Especialidad;
use App\Models\CentroSalud;
use App\Models\CategoriaDoctor;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('complete doctor pedidos functionality works', function () {
    // Setup: Crear datos base requeridos
    $role = new Role();
    $role->name = 'test-admin';
    $role->description = 'Test Administrator';
    $role->save();
    
    $user = User::create([
        'name' => 'Test User',
        'email' => 'admin@test.com',
        'password' => 'password123',
        'role_id' => $role->id,
        'email_verified_at' => now()
    ]);
    
    $zone = Zone::create([
        'name' => 'Lima Centro',
        'description' => 'Zona de Lima Centro',
        'confirmed' => true
    ]);
    
    // Crear datos maestros para doctor
    $especialidad = Especialidad::create(['name' => 'Cardiología']);
    $centroSalud = CentroSalud::create(['name' => 'Hospital Nacional', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'Categoria A',
        'prioridad' => 1,
        'monto_inicial' => 10.00,
        'monto_final' => 20.00
    ]);

    // Test 1: Crear doctor
    $doctor = new Doctor();
    $doctor->name = 'Carlos';
    $doctor->first_lastname = 'Mendoza';
    $doctor->second_lastname = 'García';
    $doctor->name_softlynn = 'Dr. Carlos Mendoza - Cardiólogo';
    $doctor->CMP = 'CMP001';
    $doctor->phone = '987654321';
    $doctor->categoria_medico = 'empresa';
    $doctor->tipo_medico = 'Prescriptor';
    $doctor->asignado_consultorio = true;
    $doctor->songs = false;
    $doctor->recovery = false;
    $doctor->state = 1;
    $doctor->aprobacion_supervisora = true;
    $doctor->especialidad_id = $especialidad->id;
    $doctor->centrosalud_id = $centroSalud->id;
    $doctor->categoriadoctor_id = $categoria->id;
    $doctor->save();

    expect($doctor)->toBeInstanceOf(Doctor::class);
    expect($doctor->name_softlynn)->toBe('Dr. Carlos Mendoza - Cardiólogo');
    
    // Test 2: Crear pedido asociado al doctor
    $pedido = Pedidos::create([
        'orderId' => 'PED-001',
        'nroOrder' => 1,
        'customerName' => 'Juan Pérez',
        'doctorName' => 'Dr. Carlos Mendoza - Cardiólogo',
        'id_doctor' => $doctor->id,
        'address' => 'Av. Lima 123',
        'reference' => 'Casa azul',
        'district' => 'Lima',
        'prize' => 250.50,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(2)->format('Y-m-d'),
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    expect($pedido)->toBeInstanceOf(Pedidos::class);
    expect($pedido->orderId)->toBe('PED-001');
    expect($pedido->id_doctor)->toBe($doctor->id);
    
    // Test 3: Verificar relación pedido -> doctor
    expect($pedido->doctor)->toBeInstanceOf(Doctor::class);
    expect($pedido->doctor->name_softlynn)->toBe('Dr. Carlos Mendoza - Cardiólogo');
    
    // Test 4: Verificar relación doctor -> pedidos
    expect($doctor->pedidos)->toHaveCount(1);
    expect($doctor->pedidos->first()->orderId)->toBe('PED-001');
    
    // Test 5: Crear segundo pedido para el mismo doctor
    $pedido2 = Pedidos::create([
        'orderId' => 'PED-002',
        'nroOrder' => 2,
        'customerName' => 'Ana García',
        'doctorName' => 'Dr. Carlos Mendoza - Cardiólogo',
        'id_doctor' => $doctor->id,
        'address' => 'Jr. Cusco 456',
        'reference' => 'Edificio blanco',
        'district' => 'Miraflores',
        'prize' => 180.00,
        'paymentStatus' => 'PAGADO',
        'deliveryDate' => now()->addDays(3)->format('Y-m-d'),
        'user_id' => $user->id,
        'zone_id' => $zone->id,
    ]);

    // Test 6: Verificar múltiples pedidos por doctor
    $doctor->refresh(); // Recargar desde la base de datos
    expect($doctor->pedidos)->toHaveCount(2);
    
    $orderIds = $doctor->pedidos->pluck('orderId')->toArray();
    expect($orderIds)->toContain('PED-001', 'PED-002');
    
    // Test 7: Verificar fechas de entrega son Carbon
    expect($pedido->deliveryDate)->toBeInstanceOf(\Carbon\Carbon::class);
    expect($pedido2->deliveryDate)->toBeInstanceOf(\Carbon\Carbon::class);
    
    // Test 8: Verificar datos en base de datos
    $this->assertDatabaseHas('doctor', [
        'name_softlynn' => 'Dr. Carlos Mendoza - Cardiólogo',
        'CMP' => 'CMP001'
    ]);
    
    $this->assertDatabaseHas('pedidos', [
        'orderId' => 'PED-001',
        'id_doctor' => $doctor->id
    ]);
    
    $this->assertDatabaseHas('pedidos', [
        'orderId' => 'PED-002', 
        'id_doctor' => $doctor->id
    ]);
});

test('doctor search functionality works', function () {
    // Crear datos requeridos
    $role = new Role();
    $role->name = 'test-role';
    $role->description = 'Test Role';
    $role->save();
    $especialidad = Especialidad::create(['name' => 'Medicina General']);
    $centroSalud = CentroSalud::create(['name' => 'Hospital Test', 'state' => 1]);
    $categoria = CategoriaDoctor::create([
        'name' => 'B', 'prioridad' => 2, 'monto_inicial' => 15.00, 'monto_final' => 25.00
    ]);

    // Crear múltiples doctores
    $doctor1 = new Doctor();
    $doctor1->name = 'María';
    $doctor1->first_lastname = 'González';
    $doctor1->second_lastname = 'Ruiz';
    $doctor1->name_softlynn = 'Dra. María González - Pediatra';
    $doctor1->CMP = 'DOC001';
    $doctor1->phone = '987111111';
    $doctor1->categoria_medico = 'empresa';
    $doctor1->tipo_medico = 'Prescriptor';
    $doctor1->asignado_consultorio = true;
    $doctor1->songs = false;
    $doctor1->recovery = false;
    $doctor1->state = 1;
    $doctor1->aprobacion_supervisora = true;
    $doctor1->especialidad_id = $especialidad->id;
    $doctor1->centrosalud_id = $centroSalud->id;
    $doctor1->categoriadoctor_id = $categoria->id;
    $doctor1->save();

    $doctor2 = new Doctor();
    $doctor2->name = 'Luis';
    $doctor2->first_lastname = 'Martínez';
    $doctor2->second_lastname = 'Torres';
    $doctor2->name_softlynn = 'Dr. Luis Martínez - Traumatólogo';
    $doctor2->CMP = 'DOC002';
    $doctor2->phone = '987222222';
    $doctor2->categoria_medico = 'visitador';
    $doctor2->tipo_medico = 'Comprador';
    $doctor2->asignado_consultorio = false;
    $doctor2->songs = true;
    $doctor2->recovery = false;
    $doctor2->state = 1;
    $doctor2->aprobacion_supervisora = true;
    $doctor2->especialidad_id = $especialidad->id;
    $doctor2->centrosalud_id = $centroSalud->id;
    $doctor2->categoriadoctor_id = $categoria->id;
    $doctor2->save();

    // Test búsqueda por nombre
    $results = Doctor::where('name_softlynn', 'LIKE', '%María%')->get();
    expect($results)->toHaveCount(1);
    expect($results->first()->name_softlynn)->toBe('Dra. María González - Pediatra');

    // Test búsqueda por especialidad
    $results = Doctor::where('name_softlynn', 'LIKE', '%Traumatólogo%')->get();
    expect($results)->toHaveCount(1);
    expect($results->first()->name_softlynn)->toBe('Dr. Luis Martínez - Traumatólogo');

    // Test búsqueda general
    $results = Doctor::where('name_softlynn', 'LIKE', '%Dr%')->get();
    expect($results)->toHaveCount(2);
});

test('pedidos fillable attributes include key fields', function () {
    $fillable = (new Pedidos())->getFillable();
    
    // Verificar solo los campos más importantes que sabemos que están
    $keyFields = ['orderId', 'customerName', 'doctorName', 'id_doctor'];

    foreach ($keyFields as $field) {
        expect($fillable)->toContain($field);
    }
    
    // Verificar que no está vacío
    expect($fillable)->not->toBeEmpty();
    expect(count($fillable))->toBeGreaterThan(10);
});

test('doctor model has basic fillable fields', function () {
    $fillable = (new Doctor())->getFillable();
    
    // Verificar campos que sabemos que existen según el código que vimos
    $basicFields = ['name_softlynn'];

    foreach ($basicFields as $field) {
        expect($fillable)->toContain($field);
    }
    
    // Verificar que no está vacío
    expect($fillable)->not->toBeEmpty();
});

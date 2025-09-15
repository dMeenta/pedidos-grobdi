<?php

use App\Http\Controllers\CargarPedidosController;
use App\Models\Doctor;
use App\Models\Pedidos;
use App\Models\User;
use App\Models\Zone;
use App\Models\Especialidad;
use App\Models\CentroSalud;
use App\Models\CategoriaDoctor;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    // Crear datos base necesarios
    $this->user = User::factory()->create();
    $this->zone = Zone::factory()->create();
    
    $this->especialidad = Especialidad::create(['name' => 'Medicina General']);
    $this->centroSalud = CentroSalud::create(['name' => 'Hospital Test', 'state' => 1]);
    $this->categoria = CategoriaDoctor::create([
        'name' => 'A',
        'prioridad' => 1,
        'monto_inicial' => 5.00,
        'monto_final' => 10.00
    ]);
    
    // Crear doctores de prueba
    $this->doctor1 = Doctor::create([
        'name' => 'Carlos',
        'first_lastname' => 'García',
        'second_lastname' => 'Mendoza',
        'name_softlynn' => 'Dr. Carlos García - Cardiólogo',
        'CMP' => '12345',
        'phone' => '987654321',
        'categoria_medico' => 'empresa',
        'tipo_medico' => 'Prescriptor',
        'asignado_consultorio' => true,
        'songs' => false,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $this->especialidad->id,
        'centrosalud_id' => $this->centroSalud->id,
        'categoriadoctor_id' => $this->categoria->id,
    ]);

    $this->doctor2 = Doctor::create([
        'name' => 'María',
        'first_lastname' => 'López',
        'second_lastname' => 'Silva',
        'name_softlynn' => 'Dra. María López - Pediatra',
        'CMP' => '54321',
        'phone' => '987654322',
        'categoria_medico' => 'visitador',
        'tipo_medico' => 'Comprador',
        'asignado_consultorio' => false,
        'songs' => true,
        'recovery' => false,
        'state' => 1,
        'aprobacion_supervisora' => true,
        'especialidad_id' => $this->especialidad->id,
        'centrosalud_id' => $this->centroSalud->id,
        'categoriadoctor_id' => $this->categoria->id,
    ]);
});

test('search doctores returns json with matching doctors', function () {
    $response = $this->get('/api/search-doctores?query=García');

    $response->assertStatus(200)
            ->assertJson([
                [
                    'id' => $this->doctor1->id,
                    'name_softlynn' => 'Dr. Carlos García - Cardiólogo'
                ]
            ]);
});

test('search doctores returns empty array when no matches found', function () {
    $response = $this->get('/api/search-doctores?query=NoExiste');

    $response->assertStatus(200)
            ->assertJson([]);
});

test('search doctores is case insensitive', function () {
    $response = $this->get('/api/search-doctores?query=garcía');

    $response->assertStatus(200)
            ->assertJsonCount(1);
            
    $responseData = $response->json();
    expect($responseData[0]['name_softlynn'])->toBe('Dr. Carlos García - Cardiólogo');
});

test('search doctores returns multiple matches', function () {
    $response = $this->get('/api/search-doctores?query=Dr');

    $response->assertStatus(200)
            ->assertJsonCount(2);
            
    $responseData = $response->json();
    $names = collect($responseData)->pluck('name_softlynn')->toArray();
    
    expect($names)->toContain(
        'Dr. Carlos García - Cardiólogo',
        'Dra. María López - Pediatra'
    );
});

test('search doctores limits results to 10', function () {
    // Crear más de 10 doctores
    for ($i = 1; $i <= 15; $i++) {
        Doctor::create([
            'name' => "Doctor{$i}",
            'first_lastname' => 'Test',
            'second_lastname' => 'Extra',
            'name_softlynn' => "Dr. Test {$i} - Medicina",
            'CMP' => "TEST{$i}",
            'phone' => "98765432{$i}",
            'categoria_medico' => 'empresa',
            'tipo_medico' => 'Prescriptor',
            'asignado_consultorio' => true,
            'songs' => false,
            'recovery' => false,
            'state' => 1,
            'aprobacion_supervisora' => true,
            'especialidad_id' => $this->especialidad->id,
            'centrosalud_id' => $this->centroSalud->id,
            'categoriadoctor_id' => $this->categoria->id,
        ]);
    }

    $response = $this->get('/api/search-doctores?query=Test');

    $response->assertStatus(200)
            ->assertJsonCount(10);
});

test('edit pedido shows correct doctor data', function () {
    $pedido = Pedidos::create([
        'orderId' => 'TEST-EDIT-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Test Edit',
        'doctorName' => 'Dr. Carlos García - Cardiólogo',
        'id_doctor' => $this->doctor1->id,
        'address' => 'Dirección Test',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 200.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $this->user->id,
        'zone_id' => $this->zone->id,
    ]);

    $response = $this->get("/edit/{$pedido->id}");

    $response->assertStatus(200)
            ->assertViewIs('pedidos.edit')
            ->assertViewHas('pedido', function ($viewPedido) use ($pedido) {
                return $viewPedido->id === $pedido->id &&
                       $viewPedido->doctor->name_softlynn === 'Dr. Carlos García - Cardiólogo';
            });
});

test('update pedido with new doctor saves correctly', function () {
    $pedido = Pedidos::create([
        'orderId' => 'TEST-UPDATE-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Test Update',
        'doctorName' => 'Dr. Carlos García - Cardiólogo',
        'id_doctor' => $this->doctor1->id,
        'address' => 'Dirección Test',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 250.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $this->user->id,
        'zone_id' => $this->zone->id,
    ]);

    $updateData = [
        'customerName' => 'Cliente Actualizado',
        'doctorName' => 'Dra. María López - Pediatra',
        'id_doctor' => $this->doctor2->id,
        'address' => 'Nueva Dirección',
        'reference' => 'Nueva Referencia',
        'district' => 'Miraflores',
        'prize' => 300.00,
        'paymentStatus' => 'PAGADO',
        'deliveryDate' => now()->addDays(2)->format('Y-m-d'),
        'deliveryStatus' => 'Entregado',
        '_token' => csrf_token(),
        '_method' => 'PUT'
    ];

    $response = $this->put("/update/{$pedido->id}", $updateData);

    $response->assertRedirect('/index')
            ->assertSessionHas('success');

    // Verificar que los datos se guardaron correctamente
    $pedido->refresh();
    expect($pedido->customerName)->toBe('Cliente Actualizado');
    expect($pedido->doctorName)->toBe('Dra. María López - Pediatra');
    expect($pedido->id_doctor)->toBe($this->doctor2->id);
    expect($pedido->district)->toBe('Miraflores');
    expect($pedido->prize)->toBe(300.00);
});

test('update pedido without doctor id keeps existing doctor', function () {
    $pedido = Pedidos::create([
        'orderId' => 'TEST-UPDATE-002',
        'nroOrder' => 1,
        'customerName' => 'Cliente Sin Doctor ID',
        'doctorName' => 'Dr. Carlos García - Cardiólogo',
        'id_doctor' => $this->doctor1->id,
        'address' => 'Dirección Test',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 180.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $this->user->id,
        'zone_id' => $this->zone->id,
    ]);

    $updateData = [
        'customerName' => 'Cliente Actualizado Sin Doctor',
        'doctorName' => 'Dr. Nuevo Doctor Manual',
        // Sin id_doctor
        'address' => 'Dirección Actualizada',
        'reference' => 'Referencia Actualizada',
        'district' => 'San Isidro',
        'prize' => 220.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(3)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        '_token' => csrf_token(),
        '_method' => 'PUT'
    ];

    $response = $this->put("/update/{$pedido->id}", $updateData);

    $response->assertRedirect('/index')
            ->assertSessionHas('success');

    // Verificar que se mantuvo el doctor original
    $pedido->refresh();
    expect($pedido->customerName)->toBe('Cliente Actualizado Sin Doctor');
    expect($pedido->doctorName)->toBe('Dr. Nuevo Doctor Manual');
    expect($pedido->id_doctor)->toBe($this->doctor1->id); // Se mantiene el original
    expect($pedido->district)->toBe('San Isidro');
});

test('update pedido with invalid data shows validation errors', function () {
    $pedido = Pedidos::create([
        'orderId' => 'TEST-VALIDATION-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Validación',
        'doctorName' => 'Dr. Carlos García - Cardiólogo',
        'id_doctor' => $this->doctor1->id,
        'address' => 'Dirección Test',
        'reference' => 'Referencia Test',
        'district' => 'Lima',
        'prize' => 150.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $this->user->id,
        'zone_id' => $this->zone->id,
    ]);

    $invalidData = [
        'customerName' => '', // Campo requerido vacío
        'doctorName' => '', // Campo requerido vacío
        'prize' => 'no-es-numero', // Valor inválido
        '_token' => csrf_token(),
        '_method' => 'PUT'
    ];

    $response = $this->put("/update/{$pedido->id}", $invalidData);

    $response->assertSessionHasErrors(['customerName', 'doctorName']);
});

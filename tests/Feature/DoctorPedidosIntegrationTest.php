<?php

use App\Models\Doctor;
use App\Models\Pedidos;
use App\Models\User;
use App\Models\Zone;
use App\Models\Especialidad;
use App\Models\CentroSalud;
use App\Models\CategoriaDoctor;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    // Crear usuario y zona
    $this->user = User::factory()->create();
    $this->zone = Zone::factory()->create();
    
    // Crear datos maestros
    $this->especialidad = Especialidad::create(['name' => 'Cardiología']);
    $this->centroSalud = CentroSalud::create(['name' => 'Hospital Integración', 'state' => 1]);
    $this->categoria = CategoriaDoctor::create([
        'name' => 'Premium',
        'prioridad' => 1,
        'monto_inicial' => 15.00,
        'monto_final' => 25.00
    ]);
});

test('complete doctor-pedido workflow works correctly', function () {
    // 1. Crear un doctor
    $doctor = Doctor::create([
        'name' => 'Integration',
        'first_lastname' => 'Test',
        'second_lastname' => 'Doctor',
        'name_softlynn' => 'Dr. Integration Test - Cardiólogo',
        'CMP' => 'INT001',
        'phone' => '987654999',
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

    // 2. Crear un pedido asociado al doctor
    $pedido = Pedidos::create([
        'orderId' => 'INTEGRATION-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Integración',
        'doctorName' => 'Dr. Integration Test - Cardiólogo',
        'id_doctor' => $doctor->id,
        'address' => 'Av. Integración 123',
        'reference' => 'Frente al parque',
        'district' => 'Lima',
        'prize' => 500.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $this->user->id,
        'zone_id' => $this->zone->id,
    ]);

    // 3. Verificar que la relación funciona
    expect($pedido->doctor)->toBeInstanceOf(Doctor::class);
    expect($pedido->doctor->name_softlynn)->toBe('Dr. Integration Test - Cardiólogo');
    expect($doctor->pedidos->contains($pedido))->toBeTrue();

    // 4. Probar búsqueda de doctores
    $response = $this->get('/api/search-doctores?query=Integration');
    $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'id' => $doctor->id,
                    'name_softlynn' => 'Dr. Integration Test - Cardiólogo'
                ]
            ]);

    // 5. Probar vista de edición
    $editResponse = $this->get("/edit/{$pedido->id}");
    $editResponse->assertStatus(200)
                ->assertViewIs('pedidos.edit')
                ->assertSee('Dr. Integration Test - Cardiólogo');

    // 6. Probar actualización del pedido
    $updateData = [
        'customerName' => 'Cliente Integración Actualizado',
        'doctorName' => 'Dr. Integration Test - Cardiólogo',
        'id_doctor' => $doctor->id,
        'address' => 'Nueva Av. Integración 456',
        'reference' => 'Al lado del hospital',
        'district' => 'Miraflores',
        'prize' => 600.00,
        'paymentStatus' => 'PAGADO',
        'deliveryDate' => now()->addDays(2)->format('Y-m-d'),
        'deliveryStatus' => 'En Proceso',
        '_token' => csrf_token(),
        '_method' => 'PUT'
    ];

    $updateResponse = $this->put("/update/{$pedido->id}", $updateData);
    $updateResponse->assertRedirect('/index')
                  ->assertSessionHas('success');

    // 7. Verificar que la actualización fue exitosa
    $pedido->refresh();
    expect($pedido->customerName)->toBe('Cliente Integración Actualizado');
    expect($pedido->address)->toBe('Nueva Av. Integración 456');
    expect($pedido->district)->toBe('Miraflores');
    expect($pedido->prize)->toBe(600.00);
    expect($pedido->paymentStatus)->toBe('PAGADO');
    expect($pedido->id_doctor)->toBe($doctor->id);
    
    // Verificar que la relación sigue intacta
    expect($pedido->doctor->name_softlynn)->toBe('Dr. Integration Test - Cardiólogo');
});

test('changing doctor in pedido updates relationship correctly', function () {
    // Crear dos doctores
    $doctor1 = Doctor::create([
        'name' => 'Primer',
        'first_lastname' => 'Doctor',
        'second_lastname' => 'Original',
        'name_softlynn' => 'Dr. Primer Doctor - Medicina General',
        'CMP' => 'DOC001',
        'phone' => '987001001',
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

    $doctor2 = Doctor::create([
        'name' => 'Segundo',
        'first_lastname' => 'Doctor',
        'second_lastname' => 'Nuevo',
        'name_softlynn' => 'Dr. Segundo Doctor - Pediatría',
        'CMP' => 'DOC002',
        'phone' => '987002002',
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

    // Crear pedido con primer doctor
    $pedido = Pedidos::create([
        'orderId' => 'CHANGE-DOC-001',
        'nroOrder' => 1,
        'customerName' => 'Cliente Cambio Doctor',
        'doctorName' => 'Dr. Primer Doctor - Medicina General',
        'id_doctor' => $doctor1->id,
        'address' => 'Dirección Cambio',
        'reference' => 'Referencia Cambio',
        'district' => 'Lima',
        'prize' => 400.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        'user_id' => $this->user->id,
        'zone_id' => $this->zone->id,
    ]);

    // Verificar relación inicial
    expect($pedido->doctor->id)->toBe($doctor1->id);
    expect($doctor1->pedidos->contains($pedido))->toBeTrue();
    expect($doctor2->pedidos->contains($pedido))->toBeFalse();

    // Cambiar al segundo doctor
    $updateData = [
        'customerName' => 'Cliente Cambio Doctor',
        'doctorName' => 'Dr. Segundo Doctor - Pediatría',
        'id_doctor' => $doctor2->id,
        'address' => 'Dirección Cambio',
        'reference' => 'Referencia Cambio',
        'district' => 'Lima',
        'prize' => 400.00,
        'paymentStatus' => 'PENDIENTE',
        'deliveryDate' => now()->addDays(1)->format('Y-m-d'),
        'deliveryStatus' => 'Pendiente',
        '_token' => csrf_token(),
        '_method' => 'PUT'
    ];

    $response = $this->put("/update/{$pedido->id}", $updateData);
    $response->assertRedirect('/index')->assertSessionHas('success');

    // Verificar que la relación cambió correctamente
    $pedido->refresh();
    $doctor1->refresh();
    $doctor2->refresh();

    expect($pedido->doctor->id)->toBe($doctor2->id);
    expect($pedido->doctorName)->toBe('Dr. Segundo Doctor - Pediatría');
    expect($doctor1->pedidos->contains($pedido))->toBeFalse();
    expect($doctor2->pedidos->contains($pedido))->toBeTrue();
});

test('multiple pedidos can be assigned to same doctor', function () {
    $doctor = Doctor::create([
        'name' => 'Multiple',
        'first_lastname' => 'Pedidos',
        'second_lastname' => 'Doctor',
        'name_softlynn' => 'Dr. Multiple Pedidos - Traumatología',
        'CMP' => 'MULTI001',
        'phone' => '987003003',
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

    $pedidos = [];
    for ($i = 1; $i <= 3; $i++) {
        $pedidos[] = Pedidos::create([
            'orderId' => "MULTI-{$i}",
            'nroOrder' => $i,
            'customerName' => "Cliente Multiple {$i}",
            'doctorName' => 'Dr. Multiple Pedidos - Traumatología',
            'id_doctor' => $doctor->id,
            'address' => "Dirección Multiple {$i}",
            'reference' => "Referencia {$i}",
            'district' => 'Lima',
            'prize' => 100.00 * $i,
            'paymentStatus' => 'PENDIENTE',
            'deliveryDate' => now()->addDays($i)->format('Y-m-d'),
            'deliveryStatus' => 'Pendiente',
            'user_id' => $this->user->id,
            'zone_id' => $this->zone->id,
        ]);
    }

    // Verificar que el doctor tiene múltiples pedidos
    expect($doctor->pedidos)->toHaveCount(3);
    
    foreach ($pedidos as $pedido) {
        expect($doctor->pedidos->contains($pedido))->toBeTrue();
        expect($pedido->doctor->id)->toBe($doctor->id);
    }

    // Verificar que todos los pedidos aparecen en la búsqueda
    $orderIds = $doctor->pedidos->pluck('orderId')->toArray();
    expect($orderIds)->toContain('MULTI-1', 'MULTI-2', 'MULTI-3');
});

test('search functionality handles special characters and accents', function () {
    $doctor = Doctor::create([
        'name' => 'José',
        'first_lastname' => 'Ramírez',
        'second_lastname' => 'Peña',
        'name_softlynn' => 'Dr. José Ramírez - Oftalmología',
        'CMP' => 'ACCENT001',
        'phone' => '987004004',
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

    // Probar búsqueda con acentos
    $response1 = $this->get('/api/search-doctores?query=José');
    $response1->assertStatus(200)->assertJsonCount(1);

    $response2 = $this->get('/api/search-doctores?query=Jose');
    $response2->assertStatus(200); // Puede o no encontrar según configuración de DB

    $response3 = $this->get('/api/search-doctores?query=Ramírez');
    $response3->assertStatus(200)->assertJsonCount(1);

    $response4 = $this->get('/api/search-doctores?query=Oftalmología');
    $response4->assertStatus(200)->assertJsonCount(1);
});

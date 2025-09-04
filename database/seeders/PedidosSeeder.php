<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pedidos;
use App\Models\DetailPedidos;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el usuario de laboratorio Juan Carlos Tarazona
        $laboratorioUser = User::where('email', 'laboratorio@grobdi.com')->first();
        
        if (!$laboratorioUser) {
            $this->command->error('Usuario laboratorio@grobdi.com no encontrado');
            return;
        }

        // Obtener zonas disponibles
        $zonas = Zone::all();
        if ($zonas->isEmpty()) {
            $this->command->error('No hay zonas disponibles');
            return;
        }

        // Productos farmacéuticos realistas
        $productosDisponibles = [
            // CAPSULAS
            ['articulo' => 'CAPSULAS PARACETAMOL 500MG', 'precio' => 15.00, 'tipo' => 'CAPSULAS'],
            ['articulo' => 'CAPSULAS IBUPROFENO 400MG', 'precio' => 18.50, 'tipo' => 'CAPSULAS'],
            ['articulo' => 'CAPSULAS OMEPRAZOL 20MG', 'precio' => 22.00, 'tipo' => 'CAPSULAS'],
            ['articulo' => 'CAPSULAS DICLOFENACO 50MG', 'precio' => 16.75, 'tipo' => 'CAPSULAS'],
            
            // JARABES
            ['articulo' => 'JARABE AMBROXOL 15MG/5ML', 'precio' => 25.00, 'tipo' => 'JARABE'],
            ['articulo' => 'JARABE ACETAMINOFEN 160MG/5ML', 'precio' => 20.00, 'tipo' => 'JARABE'],
            ['articulo' => 'JARABE DEXTROMETORFANO 15MG/5ML', 'precio' => 28.50, 'tipo' => 'JARABE'],
            ['articulo' => 'JARABE LORATADINA 5MG/5ML', 'precio' => 24.00, 'tipo' => 'JARABE'],
            
            // GOMITAS
            ['articulo' => 'GOMITAS VITAMINA C 100MG', 'precio' => 30.00, 'tipo' => 'GOMITAS'],
            ['articulo' => 'GOMITAS MULTIVITAMINICO', 'precio' => 35.00, 'tipo' => 'GOMITAS'],
            ['articulo' => 'GOMITAS OMEGA 3 500MG', 'precio' => 40.00, 'tipo' => 'GOMITAS'],
            ['articulo' => 'GOMITAS ZINC 10MG', 'precio' => 28.00, 'tipo' => 'GOMITAS'],
            
            // CREMAS Y UNGUENTOS
            ['articulo' => 'CREMA HIDROCORTISONA 1%', 'precio' => 18.00, 'tipo' => 'CREMA'],
            ['articulo' => 'UNGÜENTO DICLOFENACO 1%', 'precio' => 22.50, 'tipo' => 'UNGÜENTO'],
            ['articulo' => 'CREMA KETOCONAZOL 2%', 'precio' => 26.00, 'tipo' => 'CREMA'],
            
            // GOTAS
            ['articulo' => 'GOTAS OFTALMICAS TOBRAMICINA 0.3%', 'precio' => 32.00, 'tipo' => 'GOTAS'],
            ['articulo' => 'GOTAS NASALES OXIMETAZOLINA 0.05%', 'precio' => 18.00, 'tipo' => 'GOTAS'],
            
            // POLVOS
            ['articulo' => 'POLVO ORAL SALES REHIDRATANTES', 'precio' => 12.00, 'tipo' => 'POLVO'],
            ['articulo' => 'POLVO PROBIOTICOS', 'precio' => 45.00, 'tipo' => 'POLVO'],
        ];

        // Nombres realistas de clientes
        $clientes = [
            ['name' => 'María González Pérez', 'phone' => '987654321'],
            ['name' => 'Carlos Rodríguez Silva', 'phone' => '965432187'],
            ['name' => 'Ana Lucia Vargas', 'phone' => '945678912'],
            ['name' => 'José Miguel Torres', 'phone' => '923456789'],
            ['name' => 'Patricia Morales López', 'phone' => '956789123'],
            ['name' => 'Fernando Castro Ruiz', 'phone' => '934567812'],
            ['name' => 'Rosa Elena Mendoza', 'phone' => '967812345'],
            ['name' => 'Roberto Jiménez García', 'phone' => '921345678'],
            ['name' => 'Carmen Flores Díaz', 'phone' => '954321876'],
            ['name' => 'Miguel Angel Herrera', 'phone' => '978654321'],
            ['name' => 'Sofia Ramírez Vega', 'phone' => '932167854'],
            ['name' => 'Alberto Sánchez Cruz', 'phone' => '967543219'],
            ['name' => 'Lucía Paredes Rojas', 'phone' => '945621873'],
            ['name' => 'Daniel Gutiérrez Peña', 'phone' => '923687541'],
            ['name' => 'Isabel Medina Castro', 'phone' => '956741328'],
        ];

        // Doctores
        $doctores = [
            'Dr. Pedro Alvarez Cardiólogo',
            'Dra. Carmen Silva Pediatra',
            'Dr. Luis Mendoza Internista',
            'Dra. Ana García Ginecóloga',
            'Dr. Roberto López Dermatólogo',
            'Dra. María Rodríguez Neuróloga',
            'Dr. Carlos Vargas Traumatólogo',
            'Dra. Patricia Torres Endocrinóloga',
        ];

        // Direcciones realistas de Lima
        $direcciones = [
            ['address' => 'Av. Javier Prado Este 1234, San Isidro', 'district' => 'San Isidro'],
            ['address' => 'Calle Las Begonias 567, San Isidro', 'district' => 'San Isidro'],
            ['address' => 'Av. Larco 890, Miraflores', 'district' => 'Miraflores'],
            ['address' => 'Calle Schell 345, Miraflores', 'district' => 'Miraflores'],
            ['address' => 'Av. Universitaria 2345, Los Olivos', 'district' => 'Los Olivos'],
            ['address' => 'Calle Mercurio 678, Los Olivos', 'district' => 'Los Olivos'],
            ['address' => 'Av. Benavides 1567, Surco', 'district' => 'Surco'],
            ['address' => 'Calle Monte Bello 234, Surco', 'district' => 'Surco'],
            ['address' => 'Av. Tomás Marsano 4567, Surquillo', 'district' => 'Surquillo'],
            ['address' => 'Calle Ricardo Palma 123, Surquillo', 'district' => 'Surquillo'],
            ['address' => 'Av. Tacna 2890, Cercado de Lima', 'district' => 'Cercado de Lima'],
            ['address' => 'Jirón Junín 456, Cercado de Lima', 'district' => 'Cercado de Lima'],
        ];

        // Estados de laboratorio variados usando productionStatus
        $estadosLaboratorio = [
            ['productionStatus' => 0, 'observacion' => null, 'fecha_reprogramacion' => null],
            ['productionStatus' => 1, 'observacion' => 'Producto elaborado correctamente según especificaciones', 'fecha_reprogramacion' => null],
            ['productionStatus' => 2, 'observacion' => 'Falta de insumos, necesario reprogramar', 'fecha_reprogramacion' => Carbon::today()->addDays(2)->format('Y-m-d')],
            ['productionStatus' => 2, 'observacion' => 'Cliente solicitó cambio de fecha', 'fecha_reprogramacion' => Carbon::today()->addDays(1)->format('Y-m-d')],
            ['productionStatus' => 1, 'observacion' => 'Elaborado con fórmula mejorada', 'fecha_reprogramacion' => null],
        ];

        // Crear pedidos para hoy, ayer y mañana
        $fechas = [
            Carbon::yesterday(),
            Carbon::today(),
            Carbon::tomorrow(),
        ];

        $orderIdCounter = 1000;

        foreach ($fechas as $fecha) {
            // Crear entre 8-15 pedidos por día
            $cantidadPedidos = rand(8, 15);
            
            for ($i = 0; $i < $cantidadPedidos; $i++) {
                $cliente = $clientes[array_rand($clientes)];
                $direccion = $direcciones[array_rand($direcciones)];
                $doctor = $doctores[array_rand($doctores)];
                $zona = $zonas->random();
                $estadoLab = $estadosLaboratorio[array_rand($estadosLaboratorio)];
                
                $orderIdCounter++;
                
                $pedido = Pedidos::create([
                    'orderId' => 'ORD-' . $orderIdCounter,
                    'nroOrder' => $i + 1,
                    'customerName' => $cliente['name'],
                    'customerNumber' => $cliente['phone'],
                    'doctorName' => $doctor,
                    'address' => $direccion['address'],
                    'reference' => 'Cerca al ' . ['parque', 'mercado', 'centro comercial', 'hospital', 'iglesia'][array_rand(['parque', 'mercado', 'centro comercial', 'hospital', 'iglesia'])],
                    'district' => $direccion['district'],
                    'prize' => 0, // Se calculará después
                    'paymentStatus' => ['pagado', 'pendiente'][array_rand(['pagado', 'pendiente'])],
                    'productionStatus' => $estadoLab['productionStatus'],
                    'accountingStatus' => rand(0, 1),
                    'turno' => rand(0, 1), // 0 = mañana, 1 = tarde
                    'deliveryDate' => $fecha->format('Y-m-d'),
                    'deliveryStatus' => ['pendiente', 'en_ruta', 'entregado'][array_rand(['pendiente', 'en_ruta', 'entregado'])],
                    'user_id' => $laboratorioUser->id,
                    'zone_id' => $zona->id,
                    'observacion_laboratorio' => $estadoLab['observacion'],
                    'fecha_reprogramacion' => $estadoLab['fecha_reprogramacion'],
                ]);

                // Crear detalles del pedido (1-4 productos por pedido)
                $cantidadProductos = rand(1, 4);
                $totalPedido = 0;
                
                $productosSeleccionados = collect($productosDisponibles)->random($cantidadProductos);
                
                foreach ($productosSeleccionados as $producto) {
                    $cantidad = rand(1, 3);
                    $subtotal = $producto['precio'] * $cantidad;
                    $totalPedido += $subtotal;
                    
                    // Estado individual del producto (puede ser diferente al estado general del pedido)
                    $estadoIndividualProducto = rand(0, 2);
                    
                    DetailPedidos::create([
                        'pedidos_id' => $pedido->id,
                        'articulo' => $producto['articulo'],
                        'cantidad' => $cantidad,
                        'unit_prize' => $producto['precio'],
                        'sub_total' => $subtotal,
                        'estado_produccion' => $estadoIndividualProducto,
                    ]);
                }
                
                // Actualizar el precio total del pedido
                $pedido->update(['prize' => $totalPedido]);
            }
        }

        $this->command->info('Se han creado pedidos para ' . count($fechas) . ' días con productos farmacéuticos realistas');
        $this->command->info('Todos los pedidos están asignados al usuario: ' . $laboratorioUser->name . ' (' . $laboratorioUser->email . ')');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Zone;
use App\Models\Role;

class MotorizadoUserZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el rol de motorizado
        $motorizadoRole = Role::where('name', 'motorizado')->first();
        
        if (!$motorizadoRole) {
            $this->command->error('No se encontró el rol "motorizado"');
            return;
        }

        // Obtener todas las zonas disponibles
        $zones = Zone::all();
        
        if ($zones->isEmpty()) {
            $this->command->error('No hay zonas disponibles');
            return;
        }

        // Mapeo de usuarios motorizados con sus zonas correspondientes
        $motorizadoZoneMapping = [
            'motorizadonorte@grobdi.com' => 'Norte',
            'motorizadocentro@grobdi.com' => 'Centro', 
            'motorizadosur@grobdi.com' => 'Sur',
        ];

        foreach ($motorizadoZoneMapping as $email => $zoneName) {
            // Buscar el usuario
            $user = User::where('email', $email)->first();
            
            if ($user && $user->role_id == $motorizadoRole->id) {
                // Buscar la zona
                $zone = Zone::where('name', $zoneName)->first();
                
                if ($zone) {
                    // Asignar la zona al usuario (si no está ya asignada)
                    if (!$user->zones()->where('zone_id', $zone->id)->exists()) {
                        $user->zones()->attach($zone->id);
                        $this->command->info("Zona '{$zoneName}' asignada al usuario '{$user->name}'");
                    } else {
                        $this->command->info("Usuario '{$user->name}' ya tiene asignada la zona '{$zoneName}'");
                    }
                } else {
                    $this->command->warn("No se encontró la zona '{$zoneName}' para el usuario '{$user->name}'");
                }
            } else {
                $this->command->warn("No se encontró el usuario motorizado con email '{$email}' o no tiene el rol correcto");
            }
        }

        // Crear usuarios motorizados adicionales si no existen
        $additionalMotorizados = [
            [
                'name' => 'Motorizado Otros',
                'email' => 'motorizadootros@grobdi.com',
                'zone' => 'Otros'
            ],
            [
                'name' => 'Motorizado Recojo',
                'email' => 'motorizadorecojo@grobdi.com', 
                'zone' => 'Recojo en tienda'
            ]
        ];

        foreach ($additionalMotorizados as $motorizadoData) {
            $existingUser = User::where('email', $motorizadoData['email'])->first();
            
            if (!$existingUser) {
                // Crear el usuario
                $user = User::create([
                    'name' => $motorizadoData['name'],
                    'email' => $motorizadoData['email'],
                    'password' => bcrypt('12345678'),
                    'active' => 1,
                    'role_id' => $motorizadoRole->id,
                ]);

                // Asignar la zona
                $zone = Zone::where('name', $motorizadoData['zone'])->first();
                if ($zone) {
                    $user->zones()->attach($zone->id);
                    $this->command->info("Usuario '{$user->name}' creado y asignado a la zona '{$motorizadoData['zone']}'");
                }
            } else {
                $this->command->info("El usuario '{$motorizadoData['email']}' ya existe");
            }
        }
    }
}

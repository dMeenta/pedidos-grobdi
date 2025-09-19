<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Zone;

class AssignZoneToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-zone {email} {zone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asignar una zona a un usuario específico';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $zoneName = $this->argument('zone');

        // Buscar el usuario
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("Usuario con email '{$email}' no encontrado.");
            return 1;
        }

        // Buscar la zona
        $zone = Zone::where('name', $zoneName)->first();
        if (!$zone) {
            $this->error("Zona '{$zoneName}' no encontrada.");
            return 1;
        }

        // Verificar si ya está asignada
        if ($user->zones()->where('zone_id', $zone->id)->exists()) {
            $this->info("El usuario '{$user->name}' ya tiene asignada la zona '{$zoneName}'.");
            return 0;
        }

        // Asignar la zona
        $user->zones()->attach($zone->id);
        $this->info("Zona '{$zoneName}' asignada exitosamente al usuario '{$user->name}'.");
        
        return 0;
    }
}

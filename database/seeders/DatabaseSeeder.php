<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // User::factory(10)->create();
        
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=> bcrypt('12345678'),
            'active'=> 1,
            'role_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'visitadora sur',
            'email' => 'visitadora.sur@grobdi.com',
            'password'=> bcrypt('12345678'),
            'active'=> 1,
            'role_id' => 6,
        ]);
        $this->call(ZoneSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(UnidadesYClasificacionesSeeder::class);

    }
}

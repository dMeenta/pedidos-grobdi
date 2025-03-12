<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name'=>'Otros','description'=>'fuera de lima','confirmed'=>1],
            ['name'=>'Norte','description'=>'zona norte de lima','confirmed'=>1],
            ['name'=>'Centro','description'=>'zona centro de lima','confirmed'=>1],
            ['name'=>'Sur','description'=>'zona de sur de lima','confirmed'=>1],
            ['name'=>'Recojo en tienda','description'=>'recojo en tienda','confirmed'=>1],
            ];
            
            foreach ($zones as $zone) {
            Zone::create($zone);
            }
    }
}

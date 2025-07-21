<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**s
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ['name'=>'lunes'],
            ['name'=>'martes'],
            ['name'=>'miércoles'],
            ['name'=>'jueves'],
            ['name'=>'viernes']
            ];
            
            foreach ($days as $day) {
                Day::create($day);
            }
    }
}

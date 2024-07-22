<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regulations')->insert([
            'name' => 'Katalog FM, PVL, SVL ....',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Katalog FM, CL, SVL ....',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o elementima FM PVL, SVL ...',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o elementima FM CL, SVL ...',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o VES i ES, SVL ...',
        ]);
        
    }
}

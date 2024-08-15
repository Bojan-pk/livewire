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
            'short_name' => 'Katalog FM',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Katalog FM, CL, SVL ....',
            'short_name' => 'Katalog FM',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o elementima FM PVL, SVL ...',
            'short_name' => 'Elementi FM',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o elementima FM CL, SVL ...',
            'short_name' => 'Elementi FM',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o VES i ES, SVL ...',
            'short_name' => 'Pravilnik VES',
        ]);
        
    }
}

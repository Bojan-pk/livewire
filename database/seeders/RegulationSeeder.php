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
            'short_name' => 'Каталог ФМ',
            'svl' => 'svl 9/24',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Katalog FM, CL, SVL ....',
            'short_name' => 'Каталог ФМ',
            'svl' => 'svl 8/24',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o elementima FM PVL, SVL ...',
            'short_name' => 'Елементи ФМ',
            'svl' => 'svl 7/24',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o elementima FM CL, SVL ...',
            'short_name' => 'Елементи ФМ',
            'svl' => 'svl 6/24',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Pravilnik o VES i ES, SVL ...',
            'short_name' => 'Правилник ВЕС',
            'svl' => 'svl 5/24',
        ]);
        
    }
}

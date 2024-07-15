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
            'name' => 'Каталог ФМ ПВЛ, СВЛ...',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Каталог ФМ ЦЛ, СВЛ...',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Правилник о елементима ФМ ПВЛ, СВЛ...',
        ]);
        DB::table('regulations')->insert([
            'name' => 'Правилник о елементима ФМ ЦЛ, СВЛ...',
        ]);
        
    }
}

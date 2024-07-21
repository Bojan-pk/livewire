<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fms')->insert([
            'name' => 'Референт за финансије',
            
        ]);
        DB::table('fms')->insert([
            'name' => 'Начелник одељења',
           
        ]);
        DB::table('fms')->insert([
            'name' => 'Механичар за моторна возила',
           
        ]);
        DB::table('fms')->insert([
            'name' => 'Деловођа',
            
        ]);
        DB::table('fms')->insert([
            'name' => 'Руководилац групе',
            
        ]);
    }
}

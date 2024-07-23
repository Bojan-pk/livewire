<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->insert([
            'name' => 'Najmanje 2 godine radnog iskustva',
            'code' => 'I01',
        ]);
        DB::table('experiences')->insert([
            'name' => 'Najmanje 3 godine u zvanju ...',
            'code' => 'I02',
        ]);
        DB::table('experiences')->insert([
            'name' => 'Najmanje 3 godine na poslovima...',
            'code' => 'I03',
        ]);
       
    }
}

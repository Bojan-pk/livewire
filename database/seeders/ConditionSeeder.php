<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            'name' => 'ECDL sertifikat',
            'code' => 'PU01',
        ]);
        DB::table('conditions')->insert([
            'name' => ' STANAG sertifikat',
            'code' => 'PU02',
        ]);
        DB::table('conditions')->insert([
            'name' => 'bezbednosni sertifikat',
            'code' => 'PU03',
        ]);
        DB::table('conditions')->insert([
            'name' => 'pravosudni ispit',
            'code' => 'PU04',
        ]);
        DB::table('conditions')->insert([
            'name' => 'Vozacka dozvola',
            'code' => 'PU05',
        ]);
    }
}

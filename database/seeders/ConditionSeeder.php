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
            'name' => 'поседовање ECDL сертификата',
            'code' => 'PU01',
        ]);
        DB::table('conditions')->insert([
            'name' => 'поседовање STANAG сертификата',
            'code' => 'PU02',
        ]);
        DB::table('conditions')->insert([
            'name' => 'поседовање безбедоносног сертификата',
            'code' => 'PU03',
        ]);
        DB::table('conditions')->insert([
            'name' => 'правосудни испит',
            'code' => 'PU04',
        ]);
        DB::table('conditions')->insert([
            'name' => 'поседовање возачке дозволе',
            'code' => 'PU05',
        ]);
    }
}

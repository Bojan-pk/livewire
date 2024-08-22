<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesThirdSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ves_third_signs')->insert([
            'ves_second_sign_id' => '3',
            'sign' => '1',
            'description' => 'стрељачка општа',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_third_signs')->insert([
            'ves_second_sign_id' => '3',
            'sign' => '2',
            'description' => 'противоклопна',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_third_signs')->insert([
            'ves_second_sign_id' => '3',
            'sign' => '3',
            'description' => 'минобацачка',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_third_signs')->insert([
            'ves_second_sign_id' => '3',
            'sign' => '4',
            'description' => 'бацач граната',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_third_signs')->insert([
            'ves_second_sign_id' => '3',
            'sign' => '5',
            'description' => 'војнополицијска',
            'note' => 'neka napomena',
        ]);
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesFourthSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ves_fourth_signs')->insert([
            'ves_third_sign_id' => '1',
            'sign' => '1',
            'description' => 'стрељачка',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fourth_signs')->insert([
            'ves_third_sign_id' => '1',
            'sign' => '2',
            'description' => 'пушкомитраљеска',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fourth_signs')->insert([
            'ves_third_sign_id' => '1',
            'sign' => '3',
            'description' => 'снајперска',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fourth_signs')->insert([
            'ves_third_sign_id' => '2',
            'sign' => '4',
            'description' => 'ракетних бацача',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fourth_signs')->insert([
            'ves_third_sign_id' => '2',
            'sign' => '5',
            'description' => 'противоклопна-ракетна вођена',
            'note' => 'neka napomena',
        ]);
        
    }
}

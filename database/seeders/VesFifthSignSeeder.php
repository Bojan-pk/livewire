<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesFifthSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ves_fifth_signs')->insert([
            'sign' => 'А',
            'description' => 'основна школа',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fifth_signs')->insert([
            'sign' => 'Д',
            'description' => 'средње образовање',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fifth_signs')->insert([
            'sign' => '4',
            'description' => 'Војна академија',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fifth_signs')->insert([
            'sign' => 'Л',
            'description' => 'Мастер академске студије',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fifth_signs')->insert([
            'sign' => 'Н',
            'description' => 'докторске академске студије',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_fifth_signs')->insert([
            'sign' => '2',
            'description' => 'здравствена специјализација',
            'note' => 'neka napomena',
        ]);
    }
}

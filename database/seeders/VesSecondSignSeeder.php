<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesSecondSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ves_second_signs')->insert([
            'sign' => '1',
            'description' => 'Копнена војска',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_second_signs')->insert([
            'sign' => '2',
            'description' => 'Ратно ваздухопловство и противваздухопловна одбрана',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_second_signs')->insert([
            'sign' => 'П',
            'description' => 'пешадија',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_second_signs')->insert([
            'sign' => 'Ц',
            'description' => 'оклопне јединице',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_second_signs')->insert([
            'sign' => 'Њ',
            'description' => 'артиљерија',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_second_signs')->insert([
            'sign' => 'ж',
            'description' => 'инжињерија',
            'note' => 'neka napomena',
        ]);
    }
}

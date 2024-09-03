<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesFirstSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ves_first_signs')->insert([
            'sign' => 'Ф',
            'description' => 'официр',
            'note' => 'neka napomena',
            
        ]);
        DB::table('ves_first_signs')->insert([
            'sign' => '1',
            'description' => 'официр - професионални припадник',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_first_signs')->insert([
            'sign' => '6',
            'description' => 'резервни официр',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_first_signs')->insert([
            'sign' => 'П',
            'description' => 'подофицир',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_first_signs')->insert([
            'sign' => '2',
            'description' => 'подофицир - професионални припадник',
            'note' => 'neka napomena',
        ]);
        DB::table('ves_first_signs')->insert([
            'sign' => '7',
            'description' => 'резервни подофицир',
            'note' => 'neka napomena',
        ]);
    }
}

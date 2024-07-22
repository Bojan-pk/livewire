<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educations')->insert([
            'name' => 'GŠU',
            'code' => 'E01',
        ]);
        DB::table('educations')->insert([
            'name' => 'KŠU',
            'code' => 'E02',
        ]);
        DB::table('educations')->insert([
            'name' => 'Doktorat',
            'code' => 'E03',
        ]);
        DB::table('educations')->insert([
            'name' => 'Srednja škola',
            'code' => 'E04',
        ]);
        DB::table('educations')->insert([
            'name' => 'Fakultet',
            'code' => 'E05',
        ]);
    }
}

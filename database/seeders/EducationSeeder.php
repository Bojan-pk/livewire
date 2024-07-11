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
            'name' => 'ГШУ',
            'code' => 'E01',
        ]);
        DB::table('educations')->insert([
            'name' => 'КШУ',
            'code' => 'E02',
        ]);
        DB::table('educations')->insert([
            'name' => 'Докторат',
            'code' => 'E03',
        ]);
        DB::table('educations')->insert([
            'name' => 'Средња школа',
            'code' => 'E04',
        ]);
        DB::table('educations')->insert([
            'name' => 'Факултет',
            'code' => 'E05',
        ]);
    }
}

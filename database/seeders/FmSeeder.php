<?php

namespace Database\Seeders;

use App\Models\Fm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fm::factory()->count(50)->create();
    }
}

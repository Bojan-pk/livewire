<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Catalog;
use App\Models\Condition;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Fm;
use App\Models\Job;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();
        // \App\Models\SupportTicket::factory(2)->create();
         $this->call(ConditionSeeder::class);
         $this->call(EducationSeeder::class);
         $this->call(RegulationSeeder::class);
         $this->call(ExperienceSeeder::class);
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $catalogs = Catalog::factory(50)->create();
        
        $jobs = Job::factory(100)->create();
        $fms = Fm::factory(50)->create();
        $conditions=Condition::all();
        $educations=Education::all();
        $experiences=Experience::all();
        
        // povezivanje kataloga
        foreach ($catalogs as $catalog) {

            $catalog->fms()->attach(
                $fms->random(rand(1, 3))->pluck('id')->toArray()
            );

            $catalog->jobs()->attach(
                $jobs->random(rand(2, 6))->pluck('id')->toArray()
            );

            $catalog->conditions()->attach(
                $conditions->random(rand(0, 3))->pluck('id')->toArray()
            );

            $catalog->educations()->attach(
                $educations->random(rand(1, 3))->pluck('id')->toArray()
            );

            $catalog->experiences()->attach(
                $experiences->random(rand(1, 3))->pluck('id')->toArray()
            );

        }



    }
}

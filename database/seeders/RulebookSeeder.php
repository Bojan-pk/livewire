<?php

namespace Database\Seeders;

use App\Models\Rulebook;
use App\Models\RulebooksTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RulebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rulebooksTables=RulebooksTable::factory(30)->create();

        //$rulebooks=Rulebook::factory(50)->create();

        foreach($rulebooksTables as $rulebooksTable){

            // Kreirajte 5 Rulebook instanci i povežite ih sa trenutnom RulebooksTable instancom
            $rulebooks = Rulebook::factory(5)->create([
                'rulebooks_table_id' => $rulebooksTable->id, // Dodeljivanje ID-ja
            ]);

        // Povežite Rulebook instance sa trenutnom RulebooksTable instancom
        //$rulebooksTable->rulebooks()->attach($rulebooks->pluck('id'));
        
        } 
    }
}

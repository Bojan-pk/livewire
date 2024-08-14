<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RulebooksTable>
 */
class RulebooksTableFactory extends Factory
{
    protected static $index= 0;

    public function definition(): array
    {

        $tables = [
            "NIS", "Telekom Srbija", "Delta Holding", "Telenor Srbija", "Elektroprivreda Srbije",
            "MK Group", "Apatinska pivara", "Metalac", "Galenika", "Mlekara Subotica",
            "Komercijalna banka", "Imlek", "Bambi", "Knjaz Miloš", "Victoria Group",
            "Carnex", "Hemofarm", "Sojaprotein", "Jugoimport SDPR", "Elixir Group",
            "Agroživ", "Srbijagas", "Fidelinka", "Putevi Srbije", "Železnice Srbije",
            "Dunav osiguranje", "Jaffa Crvenka", "Lasta", "Tarkett", "Vojvođanska banka"
        ];
       
        $table =  $tables[self::$index];
            
        self::$index= (self::$index+ 1) % count($tables);

        return [
            'name'=>$table,
            'rb'=> self::$index,
        ];
    }
}

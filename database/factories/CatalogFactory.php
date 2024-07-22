<?php

namespace Database\Factories;

use App\Models\Catalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    protected $model = Catalog::class;

    // Dodaj statički brojač za praćenje trenutnog indeksa za 'id_fm'
    protected static $fmIndex = 1;

    public function definition()
    {
        $id_fm = self::$fmIndex;
        self::$fmIndex++;

        return [
            'fm_id' => $id_fm,
            'regulation_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}

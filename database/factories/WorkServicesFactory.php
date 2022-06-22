<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class WorkServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'invoices_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'amount' => $this->faker->numberBetween($min = 1, $max = 20),
            'unit' => $this->faker->word(),
            'unit_price' => $this->faker->numberBetween($min = 40, $max = 1000),
            'total' => $this->faker->numberBetween($min = 100, $max = 1000),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class PaymentServicesFactory extends Factory
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
            'payment' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'due_date' => $this->faker->date($format = 'Y-m-d', $max = '2025-10-19', $min = now()),
            'invoice_portion' => $this->faker->numberBetween($min = 20, $max = 100),
            'payment_amount' => $this->faker->numberBetween($min = 40, $max = 1000),

        ];
    }
}

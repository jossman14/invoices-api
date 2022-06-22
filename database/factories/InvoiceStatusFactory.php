<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceStatusFactory extends Factory
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
            'paid' => $this->faker->numberBetween($min = 40, $max = 500),
            'unpaid' => $this->faker->numberBetween($min = 40, $max = 1000),
            'payment_method' => $this->faker->numberBetween($min = 0, $max = 1),
            'status' => $this->faker->numberBetween($min = 0, $max = 3)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class InvoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $filepath = public_path('storage/images');

        return [
            'customer' => $this->faker->name(),
            'address' => $this->faker->address(),
            'invoice_number' => $this->faker->numerify('INV####'),
            'date' => $this->faker->date($format = 'Y-m-d', $max = now()),
            'expire_date' => $this->faker->date($format = 'Y-m-d', $max = '2025-10-19', $min = now()),
            'note' => $this->faker->text(),
            'signature' => $this->faker->image($filepath,640,480, 'cats', true, true, 'jossman'),
        ];
    }
}

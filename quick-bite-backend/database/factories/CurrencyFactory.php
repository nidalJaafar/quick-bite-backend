<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->currencyCode(),
            'symbol' => $this->faker->unique()->currencyCode(),
            'rate' => $this->faker->randomDigit()
        ];
    }
}

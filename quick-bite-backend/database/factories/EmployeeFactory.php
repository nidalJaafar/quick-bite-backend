<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'image' => $this->faker->image,
            'position' => $this->faker->randomElement(['chef', 'manager', 'waiter']),
            'fb_link' => $this->faker->domainName,
            'twitter_link' => $this->faker->domainName,
            'ig_link' => $this->faker->domainName
        ];
    }
}

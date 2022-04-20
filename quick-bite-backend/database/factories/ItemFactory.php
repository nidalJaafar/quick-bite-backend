<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'details' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['plate', 'sandwich', 'dessert', 'drink']),
            'base_price' => $this->faker->randomFloat(2, 10, 200),
            'sale' => $this->faker->numberBetween(0, 75),
            'average_rating' => $this->faker->randomFloat(3,0, 5),
            'menu_id' => $this->faker->randomElement(Menu::select('id')->get()),
            'is_trending' => (int) $this->faker->boolean
        ];
    }
}

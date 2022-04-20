<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['pending', 'delivered']),
            'item_id' => $this->faker->randomElement(Item::select('id')->get()),
            'user_id' => $this->faker->randomElement(User::select('id')->get())
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemFeedback>
 */
class ItemFeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::select('id')->get()),
            'rating' => $this->faker->randomElement([0, 1, 2, 3, 4, 5]),
            'details' => $this->faker->sentence(),
            'item_id' => $this->faker->randomElement(Item::select('id')->get())
        ];
    }
}

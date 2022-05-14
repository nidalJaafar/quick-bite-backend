<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number_of_people' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->dateTime,
            'user_id' => $this->faker->randomElement(User::select('id')->get())
        ];
    }
}

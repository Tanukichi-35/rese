<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use DateTime;

class BookingFactory extends Factory
{
    private static int $i = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'store_id' => $this->faker->numberBetween(1, 20),
            'date' => $this->faker->dateTimeBetween($startDate = '+1 day', $endDate = '+4 week'),
            'time' => new DateTime("19:00"),
            'number' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

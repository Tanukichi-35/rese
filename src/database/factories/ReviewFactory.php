<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
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
            'user_id' => $this->faker->numberBetween(1,20),
            'store_id' => $this->faker->numberBetween(1,20),
            'rate' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->realText($maxNbChars = 30),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

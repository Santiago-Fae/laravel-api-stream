<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => User::factory(),
            'id_movie' => Movie::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}

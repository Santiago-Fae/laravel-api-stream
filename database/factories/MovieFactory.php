<?php

namespace Database\Factories;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'release_date' => $this->faker->dateTime,
            'id_genre' => Genre::factory(),
        ];
    }
}

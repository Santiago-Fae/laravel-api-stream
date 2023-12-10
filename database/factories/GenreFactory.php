<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = ['Action', 'Adventure', 'Comedy', 'Crime', 'Drama', 'Fantasy', 'Historical', 'Historical fiction', 'Horror', 'Magical realism', 'Mystery', 'Paranoid Fiction', 'Philosophical', 'Political', 'Romance', 'Saga', 'Satire', 'Science fiction', 'Social', 'Speculative', 'Thriller', 'Urban', 'Western'];
        return [
            'title' => $title[rand(0, 22)]
        ];
    }
}

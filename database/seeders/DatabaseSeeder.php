<?php

namespace Database\Seeders;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenreSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RatingSeeder::class);
    }
}

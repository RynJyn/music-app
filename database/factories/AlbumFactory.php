<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $albumTitle = fake()->words(fake()->numberBetween(1, 4), true);
        return [
            'title' => $albumTitle,
            'genre' => $this->getGenre(),
            'art' => fake()->imageUrl(500, 500, null, true, $albumTitle),
            'released' => now(),
        ];
    }

    private function getGenre(): string 
    {
        $genres = ["Pop", "EDM", "Dance", "Metal", "Techno", "Rock", "Folk", "Jazz", "Blues", "Soul"];
        return fake()->randomElement($genres);

        //return $genres[$index];
    }
}

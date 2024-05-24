<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $artistName = fake()->unique()->name();
        return [
            'name' => $artistName,
            'genre' => $this->getGenre(),
            'photo' => fake()->imageUrl(500, 500, 'artists', true, $artistName)
        ];
    }

    private function getGenre(): string 
    {
        $genres = ["Pop", "EDM", "Dance", "Metal", "Techno", "Rock", "Folk", "Jazz", "Blues", "Soul"];
        return fake()->randomElement($genres);

        //return $genres[$index];
    }
}

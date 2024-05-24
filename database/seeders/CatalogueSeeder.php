<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;

class CatalogueSeeder extends Seeder
{
    protected $artistsToGenerate = 1;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Using a for loop so we can generate a differing amount of albums per artist and tracks per album
        for($i = 0; $i < 10; $i++){
            $albumsToCreate = fake()->numberBetween(1, 3);
            $tracksToCreate = fake()->numberBetween(5, 13);

            Artist::factory()
            ->has(Album::factory()
                ->count($albumsToCreate)
                ->has(
                    Track::factory()
                    ->count($tracksToCreate)
                )
            )
            ->create();
        }
    }
}

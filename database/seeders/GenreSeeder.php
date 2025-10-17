<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fantasy', 'description' => 'Stories with magical or supernatural elements.'],
            ['name' => 'Mystery', 'description' => 'Suspenseful stories involving crime or puzzles.'],
            ['name' => 'Adventure', 'description' => 'Stories filled with excitement and exploration.'],
            ['name' => 'Romance', 'description' => 'Love-centered stories.'],
            ['name' => 'Fiction', 'description' => 'Invented stories based on imagination.'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }

}

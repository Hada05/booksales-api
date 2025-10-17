<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'J.K. Rowling', 'photo' => 'jk_rowling.jpg', 'bio' => 'British author of the Harry Potter series.'],
            ['name' => 'George R.R. Martin', 'photo' => 'grr_martin.jpg', 'bio' => 'American novelist and short story writer.'],
            ['name' => 'Haruki Murakami', 'photo' => 'murakami.jpg', 'bio' => 'Japanese writer known for surrealistic novels.'],
            ['name' => 'Agatha Christie', 'photo' => 'agatha.jpg', 'bio' => 'Queen of mystery novels.'],
            ['name' => 'Rick Riordan', 'photo' => 'rick.jpg', 'bio' => 'American author of Percy Jackson series.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}

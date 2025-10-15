<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create(['title' => 'Harry Potter and the Sorcerer\'s Stone', 'author_id' => 1, 'published_year' => 1997]);
        Book::create(['title' => 'A Game of Thrones', 'author_id' => 2, 'published_year' => 1996]);
        Book::create(['title' => 'Kafka on the Shore', 'author_id' => 3, 'published_year' => 2002]);
        Book::create(['title' => 'Murder on the Orient Express', 'author_id' => 4, 'published_year' => 1934]);
        Book::create(['title' => 'The Lightning Thief', 'author_id' => 5, 'published_year' => 2005]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'description' => 'A young wizard’s journey begins.', 'price' => 19.99, 'stock' => 10, 'cover_photo' => 'hp1.jpg', 'genre_id' => 1, 'author_id' => 1],
            ['title' => 'A Game of Thrones', 'description' => 'A battle for the Iron Throne.', 'price' => 24.99, 'stock' => 8, 'cover_photo' => 'got.jpg', 'genre_id' => 1, 'author_id' => 2],
            ['title' => 'Kafka on the Shore', 'description' => 'A surreal journey of self-discovery.', 'price' => 17.50, 'stock' => 5, 'cover_photo' => 'kafka.jpg', 'genre_id' => 5, 'author_id' => 3],
            ['title' => 'Murder on the Orient Express', 'description' => 'A detective solves a mysterious murder.', 'price' => 14.99, 'stock' => 7, 'cover_photo' => 'orient.jpg', 'genre_id' => 2, 'author_id' => 4],
            ['title' => 'The Lightning Thief', 'description' => 'A boy discovers he’s a demigod.', 'price' => 15.99, 'stock' => 12, 'cover_photo' => 'lightning.jpg', 'genre_id' => 3, 'author_id' => 5],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

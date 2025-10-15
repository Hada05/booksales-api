<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::create(['name' => 'J.K. Rowling', 'bio' => 'Penulis seri Harry Potter.']);
        Author::create(['name' => 'George R.R. Martin', 'bio' => 'Penulis A Song of Ice and Fire.']);
        Author::create(['name' => 'Haruki Murakami', 'bio' => 'Penulis novel Jepang terkenal.']);
        Author::create(['name' => 'Agatha Christie', 'bio' => 'Ratu misteri dari Inggris.']);
        Author::create(['name' => 'Rick Riordan', 'bio' => 'Penulis seri Percy Jackson.']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'The Great Gatsby',
            'description' => 'A story of the fabulously wealthy Jay Gatsby...',
            'genre' => 'Fiction',
            'price' => 9.99,
            'stock' => 1,
        ]);
        Book::create([
            'title' => 'Madolduuwa',
            'description' => 'A story of the fabulously wealthy Jay Gatsby...',
            'genre' => 'Fiction',
            'price' => 10,
            'stock' => 2,
        ]);
        // Add more books
    }
}

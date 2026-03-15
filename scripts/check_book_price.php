<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Models\Book;

$book = Book::first();
if (!$book) {
    echo "No books found\n";
    exit(0);
}

echo "id={$book->id} price=" . ($book->price ?? 'NULL') . "\n";

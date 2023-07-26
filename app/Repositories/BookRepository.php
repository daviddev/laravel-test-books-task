<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookRepository
{
    /**
     * Get Book by ID.
     *
     * @param int $id
     * @return Book|null
     */
    public function getBookById(int $id): ?Book
    {
        return Book::find($id);
    }

    /**
     * Get Books.
     *
     * @return Collection
     */
    public function getBooks(): Collection
    {
        return Book::all();
    }

    /**
     * Create book.
     *
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        return Book::create($data);
    }

    /**
     * Update book.
     *
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);
        $book->refresh();

        return $book;
    }

    /**
     * Delete book.
     *
     * @param Book $book
     * @return void
     */
    public function deleteBook(Book $book): void
    {
        $book->delete();
    }
}

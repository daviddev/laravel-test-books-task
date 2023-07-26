<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    /**
     * BookService constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(private BookRepository $bookRepository)
    {
        //
    }

    /**
     * Get books.
     *
     * @return Collection
     */
    public function getBooks(): Collection
    {

        return $this->bookRepository->getBooks();
    }

    /**
     * Create book.
     *
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        return $this->bookRepository->createBook($data);
    }

    /**
     * Update book.
     *
     * @param array $data
     * @param Book $book
     * @return Book
     */
    public function updateBook(Book $book, array $data): Book
    {
        return $this->bookRepository->updateBook($book, $data);
    }

    /**
     * Delete book.
     *
     * @param Book $book
     * @return void
     */
    public function deleteBook(Book $book): void
    {
        $this->bookRepository->deleteBook($book);
    }
}

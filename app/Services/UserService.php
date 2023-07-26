<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     * @param BookRepository $bookRepository
     */
    public function __construct(private UserRepository $userRepository, private BookRepository $bookRepository)
    {
        //
    }

    /**
     * Book checkout.
     *
     * @param array $data
     * @return void
     */
    public function checkoutBook(array $data): void
    {
        $this->userRepository->checkoutBook($data);
        $book = $this->bookRepository->getBookById($data['book_id']);
        $this->bookRepository->updateBook($book, [
            'copies' => --$book->copies,
        ]);
    }

}

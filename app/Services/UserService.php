<?php

namespace App\Services;

use App\Models\Checkout;
use App\Repositories\BookRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     * @param BookRepository $bookRepository
     * @param CheckoutRepository $checkoutRepository
     */
    public function __construct(
        private UserRepository     $userRepository,
        private BookRepository     $bookRepository,
        private CheckoutRepository $checkoutRepository,
    )
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

    /**
     * Return a book.
     *
     * @param Checkout $checkout
     * @return void
     */
    public function returnBook(Checkout $checkout): void
    {
        $this->checkoutRepository->updateCheckout($checkout, [
            'return_date' => now(),
        ]);
        $this->bookRepository->updateBook($checkout->book, [
            'copies' => ++$checkout->book->copies,
        ]);
    }

}

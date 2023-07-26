<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookCheckoutRequest;
use App\Models\Checkout;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {
        //
    }

    /**
     * Book checkout.
     *
     * @param BookCheckoutRequest $request
     * @return JsonResponse
     */
    public function checkoutBook(BookCheckoutRequest $request): JsonResponse
    {
        $this->userService->checkoutBook($request->validated());

        return response()->json([
            'success' => true,
            'message' => __('response.book.checkout'),
        ]);
    }

    /**
     * Return a book.
     *
     * @param Checkout $checkout
     * @return JsonResponse
     */
    public function returnBook(Checkout $checkout): JsonResponse
    {
        $this->userService->returnBook($checkout);

        return response()->json([
            'success' => true,
            'message' => __('response.book.returned'),
        ]);
    }
}

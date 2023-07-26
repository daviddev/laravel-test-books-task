<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * BookController constructor.
     *
     * @param BookService $bookService
     */
    public function __construct(private BookService $bookService)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = $this->bookService->getBooks();

        return BookResource::collection($books)
            ->additional(['success' => true])
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->bookService->createBook($request->validated());

        return (new BookResource($book))
            ->additional([
                'success' => true,
                'message' => __('response.book.created')
            ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return (new BookResource($book))
            ->additional(['success' => true])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book = $this->bookService->updateBook($book, $request->validated());

        return (new BookResource($book))
            ->additional([
                'success' => true,
                'message' => __('response.book.updated')
            ])
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $this->bookService->deleteBook($book);

        return response()->json([
            'success' => true,
            'message' => __('response.book.deleted')
        ]);
    }
}

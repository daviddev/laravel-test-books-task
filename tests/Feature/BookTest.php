<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BookTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /**
     * Test book store endpoint
     */
    public function test_book_endpoints(): void
    {
        // store book success flow
        $user = User::factory()->create();

        $bookData = [
            'title' => 'title 1',
            'author' => 'Test test',
            'isbn' => '0-9767736-6-X',
            'copies' => 1000,
            'published_at' => Carbon::now()->subDay()
        ];

        $response = $this->json('POST', '/api/book', $bookData);

        $responseData = $response->decodeResponseJson()['data'];

        $this->assertEquals($bookData['title'], $responseData['title']);
        $this->assertEquals($bookData['author'], $responseData['author']);
        $this->assertEquals($bookData['isbn'], $responseData['isbn']);
        $this->assertEquals($bookData['copies'], $responseData['copies']);

        $bookId = $responseData['id'];

        // store book validation error flow
        $bookData = [
            'isbn' => '0-9767736-6-X',
            'copies' => 1000,
            'published_at' => 'some text'
        ];

        $response = $this->json('POST', '/api/book', $bookData);

        $responseData = $response->decodeResponseJson()['errors'];

        $this->assertEquals('The title field is required.', $responseData['title'][0]);
        $this->assertEquals('The author field is required.', $responseData['author'][0]);
        $this->assertEquals('The isbn has already been taken.', $responseData['isbn'][0]);
        $this->assertEquals('The published at field must be a valid date.', $responseData['published_at'][0]);

        // checkout success flow
        $checkoutData = [
            'user_id' => $user->id,
            'book_id' => $bookId
        ];

        $response = $this->json('POST', '/api/checkouts', $checkoutData);

        $responseData = $response->decodeResponseJson();

        $this->assertEquals( __('response.book.checkout'), $responseData['message']);

        // checkout validation error flow
        $checkoutData = [
            'user_id' => $user->id,
            'book_id' => 100
        ];

        $response = $this->json('POST', '/api/checkouts', $checkoutData);

        $responseData = $response->decodeResponseJson()['errors'];

        $this->assertEquals('The selected book id is invalid.', $responseData['book_id'][0]);
    }
}

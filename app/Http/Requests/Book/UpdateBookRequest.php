<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:255'],
            'author' => ['string', 'max:255'],
            'isbn' => ['string', 'min:13', 'max:20', "unique:books,isbn,{$this->book->id}"],
            'published_at' => ['date'],
            'copies' => ['integer', 'min:1'],
        ];
    }
}

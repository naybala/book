<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'co_id' => ['required', 'integer'],
            'publisher_id' => ['required', 'integer'],
            'book_unique_idx' => ['required', 'string',Rule::unique('tbl_book', 'book_unique_idx')
            ->where(fn($query) => $query->whereNull('deleted_at'))],
            'book_name' => ['required', 'string'],
            'cover_photo' => ['required', 'image'],
            'prize' => '',
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookDeleteRequest;
use App\Http\Requests\Book\BookShowRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService,
    ) {
    }

    public function index()
    {
        return $this->bookService->index();
    }

    public function create()
    {
        return $this->bookService->create();
    }

    public function store(BookStoreRequest $request)
    {
        return $this->bookService->store($request->validated());
    }

    public function show(BookShowRequest $request):JsonResponse
    {
        return $this->bookService->show($request->validated());
    }

    public function update(BookUpdateRequest $request):JsonResponse
    {
        return $this->bookService->update($request->validated());
    }

    public function destroy(BookDeleteRequest $request):JsonResponse
    {
        return $this->bookService->destroy($request->validated());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookDeleteRequest;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Http\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService,
    ) {
    }

    public function index():View
    {
        return $this->bookService->index();
    }

    public function list():JsonResponse
    {
        return $this->bookService->list();
    }

    public function create():View
    {
        return $this->bookService->create();
    }

    public function store(BookStoreRequest $request):RedirectResponse
    {
        return $this->bookService->store($request->validated());
    }

    public function edit(string $id):View | RedirectResponse
    {
        return $this->bookService->edit($id);
    }

    public function update(BookUpdateRequest $request):RedirectResponse
    {
        return $this->bookService->update($request->validated());
    }

    public function destroy(BookDeleteRequest $request):RedirectResponse
    {
        return $this->bookService->destroy($request->validated());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Services\BookService;
use Illuminate\Http\Request;

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

    public function store()
    {
        return $this->bookService->store();
    }

    public function show()
    {
        return $this->bookService->show();
    }

    public function update()
    {
        return $this->bookService->update();
    }

    public function destroy()
    {
        return $this->bookService->destroy();
    }
}
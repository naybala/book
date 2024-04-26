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

    /**
     * @SWG\Get(
     *     path="/books",
     *     summary="Get a list of Books",
     *     tags={"Books"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function index():JsonResponse
    {
        return $this->bookService->index();
    }

    /**
     * @SWG\POST(
     *     path="/books/store",
     *     summary="Store a Book",
     *     tags={"Books"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function store(BookStoreRequest $request):JsonResponse
    {
        return $this->bookService->store($request->validated());
    }

    /**
     * @SWG\POST(
     *     path="/books/edit",
     *     summary="Edit a Book",
     *     tags={"Books"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function show(BookShowRequest $request):JsonResponse
    {
        return $this->bookService->show($request->validated());
    }

     /**
     * @SWG\POST(
     *     path="/books/update",
     *     summary="Update a Book",
     *     tags={"Books"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function update(BookUpdateRequest $request):JsonResponse
    {
        return $this->bookService->update($request->validated());
    }

     /**
     * @SWG\POST(
     *     path="/books/delete",
     *     summary="Delete a Book",
     *     tags={"Books"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function destroy(BookDeleteRequest $request):JsonResponse
    {
        return $this->bookService->destroy($request->validated());
    }
}

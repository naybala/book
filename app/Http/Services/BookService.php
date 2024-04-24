<?php

namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Carbon\Carbon;
use Exception;

class BookService extends Controller
{
    public function __construct(
       private Book $book,
    ) {
    }

    public function index()
    {

    }

    public function store()
    {
        try{
            $this->book->beginTransaction();
            $this->book->commit();

        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
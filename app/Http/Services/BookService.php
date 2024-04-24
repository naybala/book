<?php

namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
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
        $books = $this->book::paginate(20);
        $books = BookResource::collection($books);
        return $this->sendResponse("Book Index Success",$books);
    }

    public function store(array $request)
    {
        try{
            $this->book->beginTransaction();
            $request['cover_photo']= $this->imageSave($request['cover_photo']);
            $this->book->create($request);
            $this->book->commit();
            return $this->sendResponse("Book Store Success",[]);
        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }

    private function imageSave($image):string
    {
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        return $imageName;
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
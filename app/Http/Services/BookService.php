<?php

namespace App\Http\Services;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookEditResource;
use App\Http\Resources\Book\BookIndexResource;
use App\Models\Book;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;

class BookService extends Controller
{
    public function __construct(
       private Book $book,
    ) {
    }

    public function index():JsonResponse
    {
        try{
            $books = $this->book->with(['publisher','contentOwner'])->paginate(20);
            $books = BookIndexResource::collection($books)->response()->getData(true);
            return $this->sendResponse("Book Index Success",$books);
        }catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function store(array $request):JsonResponse
    {
        try{
            $this->book->beginTransaction();
            $request['cover_photo']= $this->imageSave($request['cover_photo']);
            $request['created_at']=Carbon::now();
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
        $image->move(public_path('images/book'), $imageName);
        return $imageName;
    }

    public function show($request):JsonResponse
    {
        try{
            $book = $this->book->where('idx',$request['idx'])->first();
            $book = new BookEditResource($book);
            $book = $book->response()->getData(true);
            return $this->sendResponse("Book Show Success",$book);
        }catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function update($request):JsonResponse
    {
        try{
            $this->book->beginTransaction();
            $request['cover_photo']= $this->imageSave($request['cover_photo']);
            $request['created_at']=Carbon::now();
            $this->book->create($request);
            $this->book->commit();
            return $this->sendResponse("Book Store Success",[]);
        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }

    // public function destroy():JsonResponse
    // {

    // }
}
<?php

namespace App\Http\Services;

use App\Exceptions\NoDataException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookEditResource;
use App\Http\Resources\Book\BookIndexResource;
use App\Models\Book;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;


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

    public function show(array $request):JsonResponse
    {
        try{
            $book = $this->book->where('idx',$request['idx'])->first();
            if(!$book){
                throw new NoDataException("idx not have in table");
            }
            $book = new BookEditResource($book);
            $book = $book->response()->getData(true);
            return $this->sendResponse("Book Show Success",$book);
        }catch(NoDataException $e){
            return $this->sendNoDataResponse($e->messages());
        }catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }


    public function update(array $request):JsonResponse
    {
        try{
            $this->book->beginTransaction();
            $book = $this->book->where('idx',$request['idx'])->first()->toArray();
            if(isset($request['cover_photo'])){
                $this->imageDelete($book['cover_photo']);
                $request['cover_photo']= $this->imageSave($request['cover_photo']);
            }else{
                $request['cover_photo'] = $book['cover_photo'];
            }
            $request['updated_at']=Carbon::now();
            $this->book->where('idx',$request['idx'])->update($request);
            $this->book->commit();
            return $this->sendResponse("Book Update Success",[]);
        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(array $request):JsonResponse
    {
        try{
            $this->book->beginTransaction();
            $book = $this->book->where('idx',$request['idx'])->first();
            //$this->imageDelete($book['cover_photo']);
            $this->book->softDelete($book);
            $this->book->commit();
            return $this->sendResponse("Book Delete Success",[]);
        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }
    ///////////////////////////////////////////////////////////
    /****Private Functions *****/
    ///////////////////////////////////////////////////////////
    private function imageDelete(string $image):void
    {
        File::delete(public_path() . '/images/book/' . $image);
    }

    private function imageSave(object $image):string
    {
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/book'), $imageName);
        return $imageName;
    }
}

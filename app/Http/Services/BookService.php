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
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class BookService extends Controller
{
    public function __construct(
       private Book $book,
    ) {
    }

    public function index():View
    {
        try{
            $books = $this->book->with(['publisher','contentOwner'])->paginate(20);
            $books = BookIndexResource::collection($books)->response()->getData(true);
            return view('book.index', [
                'data' => $books,
            ]);
        }catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
    public function list():JsonResponse
    {
        try{
            $books = $this->book->with(['publisher','contentOwner'])->paginate(20);
            $books = BookIndexResource::collection($books)->response()->getData(true);
            return $this->sendResponse("books index success",$books);
        }catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function create():View
    {
        return view('book.create');
    }

    public function store(array $request):RedirectResponse
    {
        try{
            $this->book->beginTransaction();
            $request['cover_photo']= $this->imageSave($request['cover_photo']);
            $request['created_at']=Carbon::now();
            $this->book->create($request);
            $this->book->commit();
            return to_route('books.index')->with([
                'success' => 'book was successfully created',
            ]);
        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }

    public function edit($idx):View | RedirectResponse
    {
        try{
            $book = $this->book->where('idx',$idx)->first();
            if(!$book){
                throw new NoDataException("idx not have in table");
            }
            $book = new BookEditResource($book);
            $book = $book->response()->getData(true);
            return view('book.edit', [
                'data' => $book['data'],
            ]);
        }catch(NoDataException $e){
            return $this->sendNoDataResponse($e->messages());
        }catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }


    public function update(array $request):RedirectResponse
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
            return to_route('books.index')->with([
                'success' => 'book was successfully updated',
            ]);
        }catch(Exception $e){
            $this->book->rollback();
            return $this->sendError($e->getMessage());
        }
    }

    public function destroy(array $request):RedirectResponse
    {
        try{
            $this->book->beginTransaction();
            $book = $this->book->where('idx',$request['idx'])->first();
            //$this->imageDelete($book['cover_photo']);
            $this->book->softDelete($book);
            $this->book->commit();
            return to_route('books.index')->with([
                'success' => 'book was successfully deleted',
            ]);
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

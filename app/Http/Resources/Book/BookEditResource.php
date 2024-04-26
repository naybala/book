<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "idx"=>$this->idx,
            "co_id"=> $this->co_id,
            "publisher_id" => $this->publisher_id,
            "book_unique_idx" => $this->book_unique_idx,
            "book_name" => $this->book_name,
            "cover_photo" => "http://127.0.0.1:8000/images/book/".$this->cover_photo,
            "prize"=> $this->prize,
        ];
    }
}

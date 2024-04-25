<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookIndexResource extends JsonResource
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
            "co_id"=> $this->contentOwner->name,
            "publisher_id" => $this->publisher->name,
            "book_unique_idx" => $this->book_unique_idx,
            "book_name" => $this->book_name,
            "cover_photo" => "images/book/".$this->cover_photo,
            "prize"=> $this->prize,
            "created_at" => $this->created_at,
        ];
    }
}
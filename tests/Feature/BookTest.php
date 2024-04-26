<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_book_index(): void
    {
        $response = $this->get('api/books');
        $response->assertStatus(200);
    }

    public function test_book_store_without_co_id():void
    {
        $response = $this->post('api/books/store',[
            'co_id' => '',
            'publisher_id' => '1',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Name',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(422);
    }

    public function test_book_store_without_publisher_id():void
    {
        $response = $this->post('api/books/store',[
            'co_id' => '1',
            'publisher_id' => '',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Name',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(422);
    }

    public function test_book_store_without_book_unique_idx():void
    {
        $response = $this->post('api/books/store',[
            'co_id' => '1',
            'publisher_id' => '1',
            'book_unique_idx' => '',
            'book_name' => 'Name',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(422);
    }

    public function test_book_store_without_book_name():void
    {
        $response = $this->post('api/books/store',[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => '',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(422);
    }

    public function test_book_store_without_cover_photo():void
    {
        $response = $this->post('api/books/store',[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => '',
            'prize' => '100',
        ]);
        $response->assertStatus(422);
    }

    public function test_book_store_without_prize():void
    {
        $response = $this->post('api/books/store',[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '',
        ]);
        $response->assertStatus(422);
    }

    public function test_book_store_with_full_data():void
    {
        $count = Book::count();
        dd($count);
        $response = $this->post('api/books/store',[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        // $totalNumberOfBookAfter = Book::count();
        // $this->assertEquals($totalNumberOfBookBefore+1,$totalNumberOfBookAfter);
        // $response->assertStatus(200);
    }
}

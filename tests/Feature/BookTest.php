<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    /**
     * A basic feature test example.
     */
    const URL = "http://127.0.0.1:8000";
    const INDEX = self::URL."/books";
    const STORE = self::URL."/books/store";
    const UPDATE = self::URL."/books/update";
    const DELETE = self::URL."/books/delete";

    public function test_book_index(): void
    {
        $response = $this->get(self::INDEX);
        $response->assertStatus(200);
    }

    public function test_book_store_without_co_id():void
    {
        $response = $this->post(self::STORE,[
            'co_id' => '',
            'publisher_id' => '1',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Name',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_store_without_publisher_id():void
    {
        $response = $this->post(self::STORE,[
            'co_id' => '1',
            'publisher_id' => '',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Name',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_store_without_book_unique_idx():void
    {
        $response = $this->post(self::STORE,[
            'co_id' => '1',
            'publisher_id' => '1',
            'book_unique_idx' => '',
            'book_name' => 'Name',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_store_without_book_name():void
    {
        $response = $this->post(self::STORE,[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => '',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_store_without_cover_photo():void
    {
        $response = $this->post(self::STORE,[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => '',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_store_without_prize():void
    {
        $response = $this->post(self::STORE,[
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_update_without_idx():void
    {
        $response = $this->post(self::UPDATE,[
            'idx'=> '',
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_update_without_co_id():void
    {
        $response = $this->post(self::UPDATE,[
            'idx'=> '1',
            'co_id' => '',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_update_without_publisher_id():void
    {
        $response = $this->post(self::UPDATE,[
            'idx'=> '1',
            'co_id' => '1',
            'publisher_id' => '',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_update_without_book_unique_idx():void
    {
        $response = $this->post(self::UPDATE,[
            'idx'=> '1',
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => '',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_update_without_book_name():void
    {
        $response = $this->post(self::UPDATE,[
            'idx'=> '1',
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => '',
            'cover_photo' => 'name.jpg',
            'prize' => '100',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_update_without_prize():void
    {
        $response = $this->post(self::UPDATE,[
            'idx'=> '1',
            'co_id' => '1',
            'publisher_id' => '2',
            'book_unique_idx' => 'GGH123',
            'book_name' => 'Mya Than Tint',
            'cover_photo' => 'name.jpg',
            'prize' => '',
        ]);
        $response->assertStatus(405);
    }

    public function test_book_delete_without_idx():void
    {
        $response = $this->post(self::DELETE,[
            'idx'=> '1',
        ]);
        $response->assertStatus(405);
    }

}

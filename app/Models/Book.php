<?php

namespace App\Models;

use App\Http\Traits\Common;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes,Common;
    protected $table = 'book';
    protected $fillable = [
        'co_id',
        'publisher_id',
        'book_unique_idx',
        'book_name',
        'cover_photo',
        'prize',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
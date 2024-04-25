<?php

namespace App\Models;

use App\Http\Traits\Common;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes,Common;
    protected $table = 'tbl_book';
    public $timestamps = false;
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

    public function publisher():BelongsTo
    {
        return $this->belongsTo(Publisher::class,'publisher_id','idx')
            ->withDefault([
                'name'=> '---',
            ]);
    }

    public function contentOwner():BelongsTo
    {
        return $this->belongsTo(ContentOwner::class,'co_id','idx')
            ->withDefault([
                'name'=> '---',
            ]);
    }
}
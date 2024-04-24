<?php

namespace App\Models;

use App\Http\Traits\Common;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory,Common;

    protected $table = 'publisher';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
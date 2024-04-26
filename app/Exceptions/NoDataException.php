<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class NoDataException extends Exception
{
    //
    public function __construct(
        private string $error='',
    )
    {
    }

    public function messages(){
        return $this->error;
    }
}
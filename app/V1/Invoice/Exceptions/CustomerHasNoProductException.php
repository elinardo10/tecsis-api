<?php

namespace App\V1\Invoice\Exceptions;

use Exception;

class CustomerHasNoProductException extends Exception
{
    protected $message = 'User has been taken';

    public function render()
    {
        return response()->json([
            'error'   => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}

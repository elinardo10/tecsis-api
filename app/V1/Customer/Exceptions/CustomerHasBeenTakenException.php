<?php

namespace App\V1\Customer\Exceptions;

use Exception;

class CustomerHasBeenTakenException extends Exception
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

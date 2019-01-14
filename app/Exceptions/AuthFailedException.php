<?php

namespace App\Exceptions;
use Exception;

class AuthFailedException extends Exception
{
    public function render()
    {
        /*return redirect()->back()->with([
            'message' => 'These credentials do not match our records.'
        ], 422);*/

        return response()->json([
            'message' => 'These credentials do not match our records.'
        ], 422);
    }
}

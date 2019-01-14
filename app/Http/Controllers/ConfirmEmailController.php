<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmEmailController extends Controller
{
    public function index()
    {
        $token = request('token');
        $user = User::where('confirm_token', $token)->first();
        if($user) {
            $user->confirm();
            session()->flash('success', 'Your Email has been confirmed.');
            return redirect('/');
        } else {
            session()->flash('error', 'Confirmation token not recognized.');
        }
    }
}

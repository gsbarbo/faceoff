<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LogoutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();

        return redirect()->route('home')->with('alerts', [['message' => 'Logged out.', 'level' => 'success']]);
    }
}

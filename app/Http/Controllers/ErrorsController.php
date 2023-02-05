<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ErrorsController extends Controller
{
    public function notFound()
    {

        if (!Auth::check())
        {
            return  redirect()->route('user.login')->with('error', 'Need to log in first');
        }
        return view('error.404');
    }

    public function fatal()
    {

        if (!Auth::check())
        {
            return  redirect()->route('user.login')->with('error', 'Need to log in first');
        } 
        return view('error.500');
    }
}

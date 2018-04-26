<?php

namespace PHPSREPS\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function home()
    {
        return view('welcome');
    }
}

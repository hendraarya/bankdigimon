<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{
    public function index() 
    {
        if(!session()->get('email') && !session()->get('password')) 
        {
            return redirect('/login');
        }
        return view('administrator/dashadmin');
    }
}

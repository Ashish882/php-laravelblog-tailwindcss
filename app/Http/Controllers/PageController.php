<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{
    //

    public function index()
    {
        //redirect to home page
        return redirect('/blog');
       // return view('index');
    }
}

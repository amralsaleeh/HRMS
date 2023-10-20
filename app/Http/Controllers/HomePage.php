<?php

namespace App\Http\Controllers;

class HomePage extends Controller
{
    public function index()
    {
        return view('content.pages-home');
    }
}

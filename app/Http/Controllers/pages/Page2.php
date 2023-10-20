<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Page2 extends Controller
{
  public function index()
  {
    return view('content.pages.pages-page2');
  }
}

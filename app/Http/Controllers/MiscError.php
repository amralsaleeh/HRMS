<?php

namespace App\Http\Controllers;

class MiscError extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('content.pages-misc-error', ['pageConfigs' => $pageConfigs]);
    }
}

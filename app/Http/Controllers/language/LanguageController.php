<?php

namespace App\Http\Controllers\language;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function swap($locale)
    {

        if (! in_array($locale, ['ar', 'en'])) {
            abort(400);
        } else {
            session()->put('locale', $locale);
        }

        App::setLocale($locale);

        return redirect()->back();
    }
}

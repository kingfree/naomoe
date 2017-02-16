<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App;

class LanguageController extends Controller
{
    public function index($lang)
    {
        Session::put('locale', $lang);
        App::setLocale($lang);
        return Redirect::back();
    }

}
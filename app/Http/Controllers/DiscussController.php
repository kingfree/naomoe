<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussController extends Controller
{
    public function index()
    {
        language();

        return view('discuss.weibo');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussController extends Controller
{
    public function index()
    {
        return view('discuss.weibo');
    }
}

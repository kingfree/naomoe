<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Page;

class ScheduleController extends Controller
{
    public function index()
    {
        $year = Carbon::today()->year;
        $page = Page::find(1);
        if (!$page) $page = new Page;
        return view('schedule.' . $year)->withId(0)->withPage($page);
    }
}

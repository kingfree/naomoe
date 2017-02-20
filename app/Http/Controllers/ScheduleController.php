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
        $today = Carbon::today();
        $cal = Schedule::where('year', $today->year)->where('month', $today->month)->where('day', $today->day)->first();
        if ($cal and $cal->visible) {
            return route('after', ['id' => $cal->competition_id]);
        }
        $page = Page::find(1);
        if (!$page) $page = new Page;
        return view('schedule.' . $today->year)->withId(0)->withPage($page);
    }
}

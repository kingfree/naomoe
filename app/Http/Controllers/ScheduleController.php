<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $year = Carbon::today()->year;
        $schedules = Schedule::where('year', $year);
        return view('schedule.' . $year)->withDays($schedules);
    }
}

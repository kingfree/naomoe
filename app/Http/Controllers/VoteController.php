<?php

namespace App\Http\Controllers;

use App\Competition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $today = Carbon::today();
        $competition = Competition::where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->first();
        if ($competition) {
            return view('vote.doing')->withCompetition($competition);
        }
        $competition = Competition::where('end_at', '>', $now)
            ->where('start_at', $today)
            ->first();
        if ($competition) {
            return view('vote.after')->withCompetition($competition);
        }
    }
}

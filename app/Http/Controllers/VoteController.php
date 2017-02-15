<?php

namespace App\Http\Controllers;

use App\Competition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
            return redirect()->route('doing', ['id' => $competition->id]);
        }
    }

    public function willdo($id)
    {
        return view('vote.before')->withCompetition(Competition::find($id));
    }

    public function doing($id)
    {
        return view('vote.doing')->withCompetition(Competition::find($id));
    }

    public function did($id)
    {
        return view('vote.after')->withCompetition(Competition::find($id));
    }

    public function vote()
    {
        $info = [
            'ip' => request()->getClientIp(),
            'header' => request()->header(),
            'body' => request()->all()
        ];
        $compId = Input::get('competition_id');
        $votes = Input::get('votes');
        // TODO
    }
}

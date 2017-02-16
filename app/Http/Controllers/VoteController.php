<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Option;
use App\User;
use App\Vote;
use App\VoteLog;
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
        language();

        return view('vote.before')->withCompetition(Competition::find($id));
    }

    public function doing($id)
    {
        language();

        $comp = Competition::find($id);
        if (!$comp->inTime()) return redirect()->route('did', ['id' => $id]);
        return view('vote.doing')->withCompetition($comp);
    }

    public function did($id)
    {
        language();

        return view('vote.after')->withCompetition(Competition::find($id));
    }

    public function amiok()
    {
        if (Auth::check()) {
            return response(Auth::user()->name, 200);
        } else {
            return response('Not Login', 403);
        }
    }

    public function create()
    {
        $ip = request()->getClientIp();
        $user = User::firstOrCreate([
            'name' => $ip
        ]);
        Auth::login($user, true);
        return response('User Logged in', 200);
    }

    public function vote()
    {
        language();

        $ip = request()->getClientIp();
        $header = request()->header();
        $body = request()->all();
        $header['cookie'] = [];
        $header['x-xsrf-token'] = [];
        $header['x-csrf-token'] = [];

        $compId = Input::get('competition_id');

        $comp = Competition::find($compId);
        if (!$comp || !$comp->inTime()) return response()->json(['code' => 404, 'info' => __('vote.no_competition')]);
        $voteIds = Input::get('votes');
        $votes = Option::find($voteIds);
        if (!$votes || !count($votes)) return response()->json(['code' => 404, 'info' => __('vote.no_votes')]);

        $user = Auth::user();
        if (!$user) return response()->json(['code' => 403, 'info' => __('vote.not_login')]);
        $voted = VoteLog::where('user_id', $user->id)->where('competition_id', $compId)->first();
        if ($voted) return response()->json(['code' => 403, 'info' => __('vote.already_voted')]);

        $log = new VoteLog;
        $log->competition_id = $compId;
        $log->user_id = $user->id;
        $log->header = $header;
        $log->body = $body;
        $log->ip = $ip;
        $log->save();
        foreach ($votes as $option) {
            $vote = Vote::find([
                'user_id' => $user->id,
                'option_id' => $option->id
            ])->first();
            if (!$vote) {
                $vote = Vote::create([
                    'vote_log_id' => $log->id,
                    'user_id' => $user->id,
                    'option_id' => $option->id
                ]);
                $option->voted++;
                $option->valid++;
                $option->save();
            }
        }

        return response()->json(['code' => 0, 'info' => __('vote.success')]);
    }
}

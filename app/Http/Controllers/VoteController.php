<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Option;
use App\Schedule;
use App\User;
use App\VoteLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class VoteController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $today = Carbon::today();
        $competition = Competition::getNewestDoing();
        if ($competition) {
            return redirect()->route('doing', ['id' => $competition->id]);
        }
        $competition = Competition::getNewestWill();
        if ($competition) {
            return redirect()->route('before', ['id' => $competition->id]);
        }
        return redirect()->route('schedule');
    }

    public function result()
    {
        $today = Carbon::today();
        $cal = Schedule::where('year', $today->year)->where('month', $today->month)->where('day', $today->day)->first();
        if ($cal and $cal->visible) {
            return redirect()->route('after', ['id' => $cal->competition_id]);
        }
        return redirect()->route('schedule');
    }

    public function willdo($id)
    {
        language();
        $log = new VoteLog;
        return view('vote.doing')->withCompetition(Competition::find($id))->withLog($log);
    }

    public function doing($id)
    {
        language();

        $comp = Competition::find($id);
        if (!$comp) return redirect()->route('schedule');
        if (!$comp->inTime()) return redirect()->route('after', ['id' => $id]);

        $log = VoteLog::getLog($comp->id);
        return view('vote.doing')->withCompetition($comp)->withLog($log);
    }

    public function simple($id)
    {
        language();

        $comp = Competition::find($id);
        if (!$comp) return redirect()->route('schedule');
        if (!$comp->inTime()) return redirect()->route('after', ['id' => $id]);
        $log = VoteLog::getLog($comp->id);
        return view('vote.simple')->withCompetition($comp)->withLog($log);
    }

    public function did($id)
    {
        language();
        $year = Carbon::today()->year;
        $comp = Competition::find($id);
        if (!$comp) return redirect()->route('schedule');
        $log = VoteLog::getLog($id);
        return view('schedule.' . $year)->withId($id)->withCompetition($comp)->withLog($log);
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
        if (!$user->password) {
            Auth::login($user, true);
            return response('User Logged in', 200);
        } else {
            return response('Not Login', 403);
        }
    }

    public function vote()
    {
        language();

        $ip = request()->getClientIp();
        $header = request()->header();
        $body = request()->all();
        $comment = Input::get('comment');
        $header['cookie'] = [];
        $header['x-xsrf-token'] = [];
        $header['x-csrf-token'] = [];

        $compId = Input::get('competition_id');

        $comp = Competition::find($compId);
        if (!$comp || !$comp->inTime()) return response()->json(['code' => 404, 'info' => __('vote.no_competition')]);
        $voteIds = Input::get('votes');
        $votes = Option::find($voteIds);
        if (!$votes || !count($votes)) return response()->json(['code' => 404, 'info' => __('vote.no_votes')]);
        $map = [];
        foreach ($votes as $vote) {
            if (!array_key_exists($vote->group_id, $map)) {
                $map[$vote->group_id] = ['allow' => $vote->group->allow, 'count' => 0];
            }
            $map[$vote->group_id]['count']++;
            if ($map[$vote->group_id]['count'] > $map[$vote->group_id]['allow']) {
                return response()->json(['code' => 403, 'info' => __('vote.select_max', ['allow' => $map[$vote->group_id]['allow']])]);
            }
        }

        $user = Auth::user();
        if (!$user) return response()->json(['code' => 403, 'info' => __('vote.not_login')]);
        $voted = VoteLog::where('user_id', $user->id)->where('competition_id', $compId)->first();
        if ($voted) return response()->json(['code' => 403, 'info' => __('vote.already_voted')]);
        $voted = VoteLog::where('ip', $ip)->where('competition_id', $compId)->first();
        if ($voted) return response()->json(['code' => 403, 'info' => __('vote.already_voted')]);

        $log = new VoteLog;
        $log->competition_id = $compId;
        $log->user_id = $user->id;
        $log->header = $header;
        $log->body = $body;
        $log->ip = $ip;
        $log->comment = $comment;
        $log->votes = $votes->pluck('id');
        $log->save();

        return response()->json(['code' => 0, 'info' => __('vote.success')]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Option;
use App\User;
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

        return view('vote.doing')->withCompetition(Competition::find($id));
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

        $info = [
            'ip' => request()->getClientIp(),
            'header' => request()->header(),
            'body' => request()->all()
        ];
        $info['header']['cookie'] = [];
        $info['header']['x-xsrf-token'] = [];
        $info['header']['x-csrf-token'] = [];

        $compId = Input::get('competition_id');

        $comp = Competition::find($compId);
        if (!$comp) return response('Competition Not Found', 404);
        dump($comp);
        dump($info);
        $voteIds = Input::get('votes');
        $votes = Option::find($voteIds);
        dd($votes);

        $user = Auth::user();
        $log = new VoteLog;

        $log->save();

        if (!$user) {
            return response('Not Login', 403);
        }

        if ($user->voted($compId)) {
            return response()->json(['code' => 301, 'info' => __('vote.already_voted')]);
        } else {

        }
    }
}

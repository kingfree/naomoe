<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class DiscussController extends Controller
{
    public function index()
    {
        language();
        $competition = Competition::getNewestDoing();
        if (!$competition) {
            $competition = Competition::getNewestDid();
        }
        if (!$competition) {
            $competition = Competition::orderBy('start_at', 'desc')->first();
        }
        return redirect()->route('votelog', ['id' => $competition->id]);
    }

    public function votelog($id)
    {
        $competition = Competition::find($id);
        if (!$competition) {
            $competition = Competition::getNewestDoing();
            if (!$competition) {
                $competition = Competition::getNewestDid();
            }
            return redirect()->route('votelog', ['id' => $competition->id]);
        }
        return view('discuss.votes')->withCompetition($competition);
    }
}

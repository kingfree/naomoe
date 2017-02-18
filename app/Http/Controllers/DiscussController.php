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
        return redirect()->route('votelog', ['id' => $competition]);
    }

    public function votelog($id)
    {
        return view('discuss.votes')->withCompetition(Competition::find($id));
    }
}

<?php

namespace App\Admin\Controllers;

use App\Character;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIController extends Controller
{

    public function characters(Request $request)
    {
        $q = $request->get('q');

        return Character::where('name', 'like', "%$q%")
            ->orWhere('names', 'like', "%$q%")
            ->orWhere('work', 'like', "%$q%")
            ->orWhere('works', 'like', "%$q%")
            ->paginate(null);
    }
}
<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function change()
    {
        $user = Auth::user();
        if (!$user) return redirect()->back();
        return view('auth.register')
            ->withAction(url('/change'))
            ->withName($user->name)
            ->withEmail($user->email)
            ->withTitle(__('welcome.change'));
    }

    public function doChange(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();
        if (!$user) return redirect()->back();
        $usr = User::find($user->id);
        $usr->name = Input::get('name');
        $usr->email = Input::get('email');
        if (Input::get('password')) $usr->password = bcrypt(Input::get('password'));
        $usr->save();
        return redirect('change')->with('status', __('welcome.password_changed'));
    }
}


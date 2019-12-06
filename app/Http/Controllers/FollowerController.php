<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $email = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $followers = Follower::where('following', '=', $email)->get();
        $followings = Follower::select('following')->where('follower', '=', $email)->get();
        return view('friends')->with('followers', $followers)->with('followings', $followings);
    }
}

<?php

namespace App\Http\Controllers;

use App\Canal;
use App\Follower;
use App\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $members = User::where('id', '!=', auth()->user()->getAuthIdentifier())->get();
        $email = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $followers = Follower::where('following', '=', $email)->pluck('follower')->toArray();
        $followings = Follower::select('following')->where('follower', '=', $email)->pluck('following')->toArray();
        return view('members')->with('members', $members)->with('followers', $followers)->with('followings', $followings);
    }

    public function createMembersChannels() {
        $email = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $followings = Follower::select('following')->where('follower', '=', $email)->pluck('following')->toArray();
        return view('memberChannels')->with('followings', $followings);
    }

    public function getChannels(Request $request) {
        $userId = User::where('email', '=', $request->email)->first()->id;
        $channels = Canal::where('id_user', '=', $userId)->get();
        return response()->json(array('channels' => $channels), 200);
    }

    public function follow(Request $request) {
        $follower = new Follower;
        $follower->follower = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $follower->following = User::where('id', '=', $request->id)->first()->email;
        $follower->save();
        return redirect()->to('/members');
    }

    public function unfollow(Request $request) {
        $follower = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $following = User::where('id', '=', $request->id)->first()->email;
        $unfollow = Follower::where('follower', '=', $follower)->where('following', '=', $following)->first();
        $unfollow->delete();
        return redirect()->to('/members');
    }
}

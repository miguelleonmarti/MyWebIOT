<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $user = User::where('id', '=', auth()->user()->getAuthIdentifier())->first();
        return view('profile')->with('user', $user);
    }
}

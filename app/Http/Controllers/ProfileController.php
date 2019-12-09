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
        $user = User::find(auth()->user()->getAuthIdentifier());
        return view('profile')->with('user', $user);
    }

    public function update(Request $request) {
        $user = User::find(auth()->user()->getAuthIdentifier());
        $user->nombre = $request->nombre;
        $user->estado = $request->estado;
        $user->save();
        return redirect()->to('/profile');
    }
}

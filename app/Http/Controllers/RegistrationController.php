<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function create() {
        return view('register');
    }

    public function store()
    {
        $this->validate(request(), [
            'nombre' => 'required',
            'email' => 'required|email',
            'fechaNacimiento' => 'required',
            'passwd' => 'required_with:rpasswd|same:rpasswd'
        ]);

        $user = User::create(request(['nombre', 'email', 'passwd', 'fechaNacimiento']));

        auth()->login($user);

        return redirect()->to('/');
    }
}

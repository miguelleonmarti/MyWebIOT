<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('social');
    }

    public function getMessages() {
        $mensajes = Message::orderBy('created_at', 'DESC')->limit(5)->get();
        return response()->json(array('mensajes' => $mensajes), 200);
    }

    public function createMessage()
    {
        $users = User::where('id', '!=', auth()->user()->getAuthIdentifier())->get();
        $email = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $mensajes = Message::where('emisor', '=', $email)->orWhere('receptor', '=', $email)->orderBy('created_at', 'DESC')->get();
        return view('message')->with('users', $users)->with('mensajes', $mensajes);
    }

    public function newMessage(Request $request)
    {

        $this->validate(request(), [
            'receptor' => 'required|email',
            'texto' => 'required'
        ]);

        $emisor = User::where('id', '=', auth()->user()->getAuthIdentifier())->first()->email;
        $receptor = $request->receptor;
        $texto = $request->texto;
        $checkbox = $request->privado;
        if ($checkbox == 'on') {
            $privado = 1;
        } else {
            $privado = 0;
        }

        $message = new Message;
        $message['emisor'] = $emisor;
        $message['receptor'] = $receptor;
        $message['texto'] = $texto;
        $message['privado'] = $privado;

        $message->save();

        return redirect()->to('/newMessage');
    }
}

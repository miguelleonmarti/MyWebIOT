<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Grupo;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function create()
    {
        $grupos = Grupo::where('id_creador', '=', auth()->user()->getAuthIdentifier())->get();
        $email = User::where('id', auth()->user()->getAuthIdentifier())->first()->email;
        $amigos = Follower::where('follower', '=', $email)->get();
        return view('grupo')->with('grupos', $grupos)->with('amigos', $amigos);
    }

    public function addGrupo(Request $request)
    {
        $this->validate(request(), [
            'nombre' => 'required'
        ]);

        if (Grupo::where('nombre', $request->nombre)->first() == null) {
            $grupo = new Grupo();
            $grupo['id_creador'] = auth()->user()->getAuthIdentifier();
            $grupo['id_invitado'] = auth()->user()->getAuthIdentifier();
            $grupo['nombre'] = $request->nombre;
            $grupo->save();
        }

        return redirect()->to('/grupos');
    }

    public function deleteGrupo($id)
    {
        $grupo = Grupo::find($id);
        $grupo->delete();
        return redirect()->to('/grupos');
    }

    public function addInvitado(Request $request)
    {
        $this->validate(request(), [
            'amigo' => 'required',
            'grupo' => 'required'
        ]);

        $grupo = new Grupo();
        $grupo['nombre'] = $request->grupo;
        $grupo['id_creador'] = auth()->user()->getAuthIdentifier();
        $id_invitado = User::where('email', $request->amigo)->first()->id;
        $grupo['id_invitado'] = $id_invitado;

        $grupo->save();

        return redirect()->to('/grupos');
    }

    public function enviarMensaje(Request $request)
    {
        $this->validate(request(), [
            'mensaje' => 'required',
            'grupo' => 'required'
        ]);

        $grupos = Grupo::where('nombre', $request->grupo)->get();

        foreach ($grupos as $grupo) {
            if ($grupo->id_creador != $grupo->id_invitado) {
                $message = new Message();
                $message['emisor'] = User::where('id', $grupo->id_creador)->first()->email;
                $message['receptor'] = User::find($grupo->id_invitado)->email;;
                $message['texto'] = $request->mensaje;
                $message['privado'] = 1;
                $message->save();
            }
        }

        return redirect()->to('/grupos');
    }
}

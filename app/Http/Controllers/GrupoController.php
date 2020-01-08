<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Grupo;
use App\Message;
use App\User;
use App\UsuarioGrupo;
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

        $id_usuario = User::where('email', $request->amigo)->first()->id;
        $id_grupo = Grupo::where('nombre', $request->grupo)->first()->id;

        if (UsuarioGrupo::where('id_usuario', $id_usuario)->where('id_grupo', $id_grupo)->first() == null) {
            $invitado = new UsuarioGrupo();
            $invitado['id_usuario'] = $id_usuario;
            $invitado['id_grupo'] = $id_grupo;
            $invitado->save();
        }

        return redirect()->to('/grupos');
    }

    public function enviarMensaje(Request $request)
    {
        $this->validate(request(), [
            'mensaje' => 'required',
            'grupo' => 'required'
        ]);

        $idGrupo = Grupo::where('nombre', $request->grupo)->first()->id;
        $usuariosGrupo = UsuarioGrupo::where('id_grupo', $idGrupo)->get();

        foreach ($usuariosGrupo as $usuario) {
            $message = new Message();
            $message['emisor'] = User::find(auth()->user()->getAuthIdentifier())->email;
            $message['receptor'] = User::find($usuario->id_usuario)->email;;
            $message['texto'] = $request->mensaje;
            $message['privado'] = 1;
            $message->save();
        }

        return redirect()->to('/grupos');
    }

    public function createGrupo($id)
    {
        $grupo = Grupo::find($id)->first();
        $usuarios = UsuarioGrupo::where('id_grupo', $id)->get();

        return view('grupoDetalle')
            ->with('grupo', $grupo)
            ->with('usuarios', $usuarios);
    }

    public function deleteInvitado($id_grupo, $id_usuario) {
        $usuario_grupo = UsuarioGrupo::where('id_grupo', $id_grupo)->where('id_usuario', $id_usuario)->first();
        $usuario_grupo->delete();

        return redirect()->to('/grupo/' . $id_grupo);
    }

}

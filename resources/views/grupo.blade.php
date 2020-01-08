@extends('common')

@section('title', 'Grupo')

@section('body')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">Crear grupo</div>
                <div class="card-body">
                    <form action="/addGrupo" class="text-center m-auto" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" id="nombre" name="nombre"
                                placeholder="Nombre del grupo..." required></input>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Crear
                                grupo</button>
                            <button class="btn btn-primary btn-block" type="reset"
                                id="cancelCreateChannelButton">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Añadir invitado</div>
                <div class="card-body">
                    <form action="/addInvitado" class="text-center m-auto" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <select name="amigo" class="form-control">
                                <option value="" selected>Amigo</option>
                                @foreach ($amigos as $amigo)
                                <option value="{{ $amigo->following }}">{{ $amigo->following }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <select name="grupo" class="form-control">
                                <option value="" selected>Grupo</option>
                                @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->nombre }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Crear
                                grupo</button>
                            <button class="btn btn-primary btn-block" type="reset"
                                id="cancelCreateChannelButton">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Enviar mensaje</div>
                <div class="card-body">
                    <form action="/enviarMensaje" class="text-center m-auto" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" id="mensaje" name="mensaje"
                                placeholder="Mensaje..." required></input>
                        </div>
                        <div class="form-group mt-3">
                            <select name="grupo" class="form-control">
                                <option value="" selected>Grupo</option>
                                @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->nombre }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block" type="submit">Enviar</button>
                            <button class="btn btn-primary btn-block" type="reset">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Mis grupos</div>
                <div class="card-body">
                    @foreach ($grupos as $grupo)
                    @if ($grupo->nombre != "")
                    <div class="card">
                        <div class="card-header">
                            <form style="display: inline;" action="/eliminarGrupo/{{ $grupo->id }}" method="get">
                                <button class="btn btn-danger" type="submit">Eliminar grupo</button>
                            </form>
                            <h3 style="display: inline;"><a href="/grupo/{{ $grupo->id }}"></a>{{$grupo->nombre}}</h3>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

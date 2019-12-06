@extends('common')

@section('title', 'New Message')

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
                <div class="card-header">Enviar mensaje</div>
                <div class="card-body">
                    <form action="/newMessage" class="text-center m-auto" method="POST">
                        @csrf
                        <i class="material-icons">add_circle_outline</i>
                        <div class="form-group mt-3">
                            <select name="receptor" class="form-control">
                                <option value="" selected>Destinatario</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->email }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="auto" id="texto" name="texto" placeholder="Mensaje..."
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privado" name="privado">
                                <label class="form-check-label" for="defaultCheck1">
                                    Privado
                                </label>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Enviar
                                mensaje</button>
                            <button class="btn btn-primary btn-block" type="reset"
                                id="cancelCreateChannelButton">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Mensajes</div>
                <div class="card-body">
                    @foreach ($mensajes as $mensaje)
                    @if ($mensaje->privado == 1)
                    <i class="material-icons" style="display: inline;">lock_outline</i>
                    @endif
                    <h6 style="display: inline;"><strong>{{$mensaje->emisor}} >>> {{$mensaje->receptor}}</strong></h6></br>
                    <p><i>"{{$mensaje->texto}}" a las {{$mensaje->created_at}}</i></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

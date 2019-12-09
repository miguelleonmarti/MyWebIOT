@extends('common')

@section('title', 'Profile')

@section('body')

<div class="container mt-3">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <form action="/profile" class="text-center m-auto" method="POST">
                @csrf
                <i class="material-icons" style="font-size: 100px;">person_outline</i>
                <div class="form-group mt-3">
                    <label>Nombre</label>
                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="{{ $user->nombre }}"
                        required>
                </div>
                <div class="form-group mt-3">
                    <label>Estado</label>
                    <input class="form-control" type="text" id="estado" name="estado" placeholder="{{ $user->estado }}"
                        required>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Actualizar</button>
                    <button class="btn btn-primary btn-block" type="reset"
                        id="cancelCreateChannelButton">Cancelar</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

@endsection

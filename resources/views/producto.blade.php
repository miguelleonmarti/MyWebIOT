@extends('common')

@section('title', 'Update Product')

@section('body')

<div class="d-xl-flex login-dark" id="newChannelDiv">
    <form action="/" class="text-center border rounded" method="POST" id="form">
        @csrf
        @method('UPDATE') //TODO:
        <i class="material-icons">add_circle_outline</i>
        <div class="form-group">
            <input class="form-control" type="text" id="nombreCanal" name="nombreCanal" placeholder="Nombre del canal" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="auto" id="descripcion" name="descripcion" placeholder="Descripción..." required></textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="longitud" name="longitud" placeholder="Longitud" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="latitud" name="latitud" placeholder="Latitud" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="nombreSensor" name="nombreSensor" placeholder="Nombre del sensor" required>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Crear canal</button>
            <button class="btn btn-primary btn-block" type="submit" id="cancelCreateChannelButton">Cancelar</button>
        </div>
        <a class="forgot" href="#">You already have an account? Log in here.</a>
    </form>
</div>

@endsection

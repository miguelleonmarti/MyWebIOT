@extends('common')

@section('title', 'Support')

@section('body')

<div class="d-xl-flex login-dark" id="supportDiv">
    <form class="text-center border rounded" method="POST" action="/suggestion" id="form">
        @csrf
        <i class="material-icons">help_outline</i>
        <div class="form-group">
            <input class="form-control" id="email" name="email" type="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="name" name="name" placeholder="Nombre y apellidos">
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="auto" id="message" name="message" placeholder="Sugerencia..."></textarea>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block" type="submit" id="sendMessageButton">Enviar</button>
            <button class="btn btn-primary btn-block" type="submit" id="cancelMessageButton">Cancelar</button>
        </div>
        <a class="forgot" href="login.php">You already have an account? Log in here.</a>
    </form>
</div>

@endsection

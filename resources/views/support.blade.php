@extends('common')

@section('title', 'Support')

@section('body')

<div class="d-xl-flex login-dark" id="supportDiv">
    <form class="text-center border rounded" method="post" id="form">
        <i class="material-icons">help_outline</i>
        <div class="form-group">
            <input class="form-control" type="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Asunto">
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="auto" placeholder="Descripción..."></textarea>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block" type="submit" id="sendMessageButton">Enviar</button>
            <button class="btn btn-primary btn-block" type="submit" id="cancelMessageButton">Cancelar</button>
        </div>
        <a class="forgot" href="login.php">You already have an account? Log in here.</a>
    </form>
</div>

@endsection

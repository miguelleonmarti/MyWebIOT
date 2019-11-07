@extends('common')

@section('title', 'Register')

@section('body')

<div class="d-xl-flex login-dark" id="registerDiv">
    <form action="/register" class="text-center border rounded" method="POST" id="form">
        @csrf
        <i class="material-icons">person</i>
        <div class="form-group">
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Name" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="date" id="fechaNacimiento" name="fechaNacimiento" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" id="passwd" name="passwd" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" id="rpasswd" name="rpasswd" placeholder="Repeat Password" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" id="registerUserButton">Create account</button>
            <button class="btn btn-primary btn-block" type="submit" id="cancelMessageButton">Cancel</button>
        </div>
        <a class="forgot" href="#">You already have an account? Log in here.</a>
    </form>
</div>

@endsection

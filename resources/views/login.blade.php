@extends('common')

@section('title', 'Login')

@section('body')

<div class="d-xl-flex login-dark" id="loginDiv">
    <form action="/login" id="form" class="text-center border rounded" method="POST">
        @csrf
        <i class="icon-lock"></i>
        <div class="form-group">
            <input class="form-control" type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" id="formSubmit">Log In</button>
            <button class="btn btn-primary btn-block" type="submit" id="formCancel">Cancel</button>
        </div>
        <a class="forgot" href="#">Forgot your email or password?</a>
    </form>
</div>

@endsection

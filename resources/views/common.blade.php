<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyWebIoT: @yield('title')</title>

    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="/assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="/assets/css/Channel.css">
    <link rel="stylesheet" href="/assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="/assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="/assets/css/styles.css">

    @yield('links')
</head>

<body>
    <header>
        <nav class="navbar navbar-dark navbar-expand-md bg-dark" id="nav">
            <div class="container-fluid">
                <img src="https://www.stickpng.com/assets/images/584830f5cef1014c0b5e4aa1.png" width="50px" id="logo">
                <a class="navbar-brand" href="/">MiWebIoT</a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/channelList">Canales</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/support">Atención al Cliente</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="#">Contacto</a></li>
                        <!-- Changes the href of channels if logged in -->
                    </ul>
                    <ul class="nav navbar-nav ml-auto align-items-md-center">
                        @if ( auth()->check() )
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/#">{{ auth()->user()->email }}</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/logout">Logout</a></li>
                        @else
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/login">Login</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/register">Register</a></li>
                        @endif
                    </ul>
                    <!-- Logout appears if user is logged in-->
                </div>
            </div>
        </nav>
    </header>

    @yield('body')

    <script src="assets/js/jquery.min.js"></script> <!-- JQuery -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script> <!-- Bootstrap -->
</body>

</html>

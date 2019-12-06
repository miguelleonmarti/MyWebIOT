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
                        <li class="nav-item" role="presentation"><a class="nav-link active"
                                href="/channelList">Canales</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/support">Atención al
                                Cliente</a></li>
                        @if(auth()->check())
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/buyProduct">Compra
                                productos</a></li>
                        @endif
                        <!-- Changes the href of channels if logged in -->
                    </ul>
                    <ul class="nav navbar-nav ml-auto align-items-md-center">
                        @if ( auth()->check() )
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/social">Social</a>
                        </li>
                        <li class="nav-item" role="presentation"><a class="nav-link active"
                                href="/#">{{ auth()->user()->email }}</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/logout">Logout</a>
                        </li>
                        @else
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="/login">Login</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active"
                                href="/register">Register</a></li>
                        @endif

                        <li class="nav-item d-lg-flex align-items-lg-center" data-toggle="modal"
                            data-target="#shoppingCartModal" role="presentation"><i class="material-icons" style="display: inline; color: rgb(255,255,255); font-size: 24px; padding: 8px;">shopping_cart</i></li>

                        <div class="modal fade" id="shoppingCartModal" tabindex="-1" role="dialog"
                            aria-labelledby="shoppingCartModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="shoppingCartModalTitle">Shopping cart</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(Cart::content() as $cartItem)
                                                <tr>
                                                    <td>
                                                        <!-- Remove product button -->
                                                        <form action="/remove" method="POST" style="all:unset;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="rowId" id="rowId"
                                                                value="{{ $cartItem->rowId }}">
                                                            <button type="submit" class="btn btn-danger">x</button>
                                                        </form>
                                                    </td>
                                                    <td>{{ $cartItem->name }}</td>
                                                    <td>{{ $cartItem->qty }}</td>
                                                    <td>${{ number_format($cartItem->price, 2) }}</td>
                                                    <td>${{ number_format($cartItem->price * $cartItem->qty, 2) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <!-- Total price of whole cart -->
                                                    <td class="uk-text-bold">${{ number_format(Cart::subtotal(), 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        @if(Cart::count() != 0)
                                        <!-- Clear shopping cart button -->
                                        <form action="/destroy" method="POST" style="all:unset;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Empty
                                            </button>
                                        </form>
                                        <!-- Proceed to checkout button -->
                                        <a href="/checkout" class="btn btn-primary">Checkout</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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

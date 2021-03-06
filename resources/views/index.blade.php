@extends('common')

@section('title', 'Home')

@section('links')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    function getMessage() {
        $.ajax({
            type:'POST',
            url:'/getStats',
            data:{'_token' : '{{ csrf_token() }}'},
            success:function(data) {
                $("#nUsers").html(data.nUsers);
                $("#nSugerencias").html(data.nSugerencias);
                $("#nCanales").html(data.nCanales);
                $("#nProductos").html(data.nProductos);
                $("#nBytes").html(data.nBytes);
            }
        });

        setTimeout(getMessage, 10000); // cada 10 segundos
    }
</script>
@endsection

@section('body')

<div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-warning" uk-alert>
            {{ Session::get('error') }}
            @php
            Session::forget('error');
            @endphp
        </div>
        @endif
</div>

<aside class="text-break text-left border rounded border-dark float-right" id="aside">
    <header>
        <h4>Información actualizada de los datos almacenados en la base de datos (al menos los siguientes):</h4>
    </header>
    <p>Número de usuarios: <span id="nUsers"></span></p>
    <p>Número de canales: <span id="nCanales"></span></p>
    <p>Número de sugerencias: <span id="nSugerencias"></span></p>
    <p>Número de productos: <span id="nProductos"></span></p>
    <p>Número de bytes almacenados: <span id="nBytes"></span> KB</p>
</aside>
<aside
    style="all: unset; float: left; border: 2px solid black; border-radius: 10px; padding: 10px; margin-left: 10px; margin-top: 10px; background: #53c1de;"
    witdh="20%">
    <ul class="nav navbar-nav">
        <li class="nav-item" role="presentation"><a class="nav-link active" href="/channelList">Canales</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link active" href="/support">Atención al Cliente</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link active" href="#">Contacto</a></li>
        <!-- Changes the href of channels if logged in -->
    </ul>
</aside>
<section id="firstSection" style="margin-left: 270px;">
    <article class="text-center border rounded border-dark">
        <header>
            <h2>Escuela de Ing. de Telecomunicación y Electrónica</h2>
        </header>
        <p>Esto es una página web que estamos diseñando en la práctica de Programación Web.</p>

    </article>
</section>
<section id="secondSection">
    <article class="text-center border rounded border-dark">
        <header>
            @if (auth()->check())
            <h2>Tus últimos canales</h2>
            @else
            <h2>Últimos canales de los usuarios</h2>
            @endif
        </header>
        @if($chart1)<div id="chartContainer1" class="chartContainer">{!! $chart1->container() !!}</div>@endif
        @if($chart2)<div id="chartContainer2" class="chartContainer">{!! $chart2->container() !!}</div>@endif
    </article>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@if($chart1){!! $chart1->script() !!}@endif
@if($chart2){!! $chart2->script() !!}@endif

@if($chart1 != null && $chart2 != null)
<script>
    function refreshCharts() {
        {{ $chart1->id }}_refresh('/getCharts/1');
        {{ $chart2->id }}_refresh('/getCharts/2');
        setTimeout(refreshCharts, 10000);
    }
    refreshCharts();
</script>
@elseif($chart1 != null)
<script>
    function refreshCharts() {
        {{ $chart1->id }}_refresh('/getCharts/1');
        setTimeout(refreshCharts, 10000);
    }
    refreshCharts();
</script>
@endif

<script>
    getMessage();
</script>

<!-- EXAMEN EJERCICIO 4 -->

<?php
    if (isset($_COOKIE['last_access'])) {
        echo "<script type='text/javascript'>alert('Hace menos de 7 días que nos ha visitado');</script>";
        //alert("");
    }
    setcookie("last_access", "now", time() + 604800); // 7 dias
?>

<!-- EXAMEN EJERCICIO 4 -->

@if(auth()->check())
@if (auth()->user()->getAuthIdentifier() == 1)

<div class="text-center login-dark" id="channelListHeader">
    <header class="border rounded">
        <h3>Listado de todos los usuarios</h3>
    </header>
    <section>
        @if (isset($usuarios))
        @foreach ($usuarios as $usuario)
        <article class="border rounded border-dark" style="margin-bottom: 10px;">
            <header>
                <form action="userList/{{ $usuario->id }}" method="POST" style="all:unset;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border rounded float-right" type="submit">
                        <i class="material-icons d-xl-flex justify-content-xl-center"
                            style="color: rgb(255,255,255);">delete</i>
                    </button>
                </form>

            </header>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Nombre: {{ $usuario->nombre }}</p>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Email: {{ $usuario->email }}<br></p>
        </article>
        @endforeach
        @endif
    </section>
</div>

<div class="text-center login-dark" id="channelListHeader">
    <header class="border rounded">
        <h3>Listado de todos los canales</h3>
    </header>
    <section>
        @if (isset($canales))
        @foreach ($canales as $canal)
        <article class="border rounded border-dark" style="margin-bottom: 10px;">
            <header>
                <form action="channelList/{{ $canal->id }}" method="POST" style="all:unset;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border rounded float-right" type="submit">
                        <i class="material-icons d-xl-flex justify-content-xl-center"
                            style="color: rgb(255,255,255);">delete</i>
                    </button>
                </form>

            </header>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Nombre canal: {{ $canal->nombreCanal }}</p>
        </article>
        @endforeach
        @endif
    </section>
</div>

<div class="text-center login-dark" id="channelListHeader">
    <header class="border rounded">
        <h3>Listado de todas las sugerencias</h3>
    </header>
    <section>
        @if (isset($sugerencias))
        @foreach ($sugerencias as $sugerencia)
        <article class="border rounded border-dark" style="margin-bottom: 10px;">
            <header>
                <form action="suggestionList/{{ $sugerencia->id }}" method="POST" style="all:unset;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border rounded float-right" type="submit">
                        <i class="material-icons d-xl-flex justify-content-xl-center"
                            style="color: rgb(255,255,255);">delete</i>
                    </button>
                </form>

            </header>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Nombre: {{ $sugerencia->name }}</p>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Email: {{ $sugerencia->email }}</p>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Sugerencia: {{ $sugerencia->message }}<br>
            </p>
        </article>
        @endforeach
        @endif
    </section>
</div>

<div class="text-center login-dark" id="channelListHeader">
        <header class="border rounded">
            <h3>Listado de todos los productos</h3>
        </header>
        <section>
            @if (isset($productos))
            @foreach ($productos as $producto)
            <article class="border rounded border-dark" style="margin-bottom: 10px;">
                <header>
                    <form action="productList/{{ $producto->id }}" method="POST" style="all:unset;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger border rounded float-right" type="submit">
                            <i class="material-icons d-xl-flex justify-content-xl-center"
                                style="color: rgb(255,255,255);">delete</i>
                        </button>
                    </form>

                </header>
                <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Nombre: {{ $producto->nombre }}</p>
                <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Descripción: {{ $producto->descripcion }}</p>
                <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Cantidad: {{ $producto->cantidad }}</p>
                <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Precio: {{ $producto->precio }} euros<br></p>
                <a href="/product/{{ $producto->id }}">Editar producto</a>
            </article>
            @endforeach
            @endif
        </section>
    </div>

<div class="d-xl-flex login-dark" id="newChannelDiv">
    <form action="/newProduct" class="text-center border rounded" method="POST" id="form">
        @csrf
        <i class="material-icons">add_circle_outline</i>
        <div class="form-group">
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del producto"
                required>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="auto" id="descripcion" name="descripcion" placeholder="Descripción..."
                required></textarea>
        </div>
        <div class="form-group">
                <input class="form-control" type="number" min="0" max="2147483647" id="cantidad" name="cantidad" placeholder="Cantidad..."
                    required></input>
            </div>
        <div class="form-group">
            <input class="form-control" type="number" min="0" max="2147483647" step="0.01" id="precio" name="precio" placeholder="Precio" required>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Crear producto</button>
            <button class="btn btn-primary btn-block" type="submit" id="cancelCreateChannelButton">Cancelar</button>
        </div>
    </form>
</div>

@endif
@endif

@endsection

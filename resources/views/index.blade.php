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
                $("#nCanales").html(data.nCanales);
                $("#nBytes").html(data.nBytes);
            }
        });

        setTimeout(getMessage, 10000);
    }
</script>
@endsection

@section('body')

<aside class="text-break text-left border rounded border-dark float-right" id="aside">
    <header>
        <h4>Información actualizada de los datos almacenados en la base de datos (al menos los siguientes):</h4>
    </header>
    <p>Número de usuarios: <span id="nUsers"></span></p>
    <p>Número de canales: <span id="nCanales"></span></p>
    <p>Número de bytes almacenados: <span id="nBytes"></span> KB</p>
</aside>
<section id="firstSection">
    <article class="text-center border rounded border-dark">
        <header>
            <h2>MiWebIoT</h2>
        </header>
        <p>Esto es una página web que estamos diseñando en la práctica de Programación Web.</p>
        <footer
            class="d-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-end">
            <button class="btn btn-dark" type="button">¡Entra ya!</button>
        </footer>
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
<script>
    function refreshCharts() {
        {{ $chart1->id }}_refresh('/getCharts/1');
        {{ $chart2->id }}_refresh('/getCharts/2');
        setTimeout(refreshCharts, 10000);
    }
</script>
<script>
    getMessage();
    refreshCharts();
</script>
@endsection

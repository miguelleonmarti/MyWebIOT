@extends('common')

@section('title', 'Buy product')

@section('body')

@if (isset($productos) && auth()->check())
@foreach ($productos->chunk(3) as $chunk)
<!-- Number of rows -->

<div class="container mt-5">
    <div class="card-deck mb-3 text-center">
        @foreach ($chunk as $producto)
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ $producto->nombre }}</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">${{ $producto->precio }}<small class="text-muted">/
                        mes</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>{{ $producto->descripcion }}</li>

                    @if ($producto->cantidad != 0)
                    <li>Quedan <strong>{{ $producto->cantidad }}</strong> en stock.</li>
                    @else
                    <li><strong>Fuera de stock.</strong></li>
                    @endif

                </ul>

                @if ($producto->cantidad != 0)
                <form action="/add/{{ $producto->id }}" method="POST" style="all: unset;">
                    @csrf
                    <button type="submit"
                        class="btn btn-lg btn-outline-primary btn-block align-self-center mt-auto">Comprar</button>
                </form>
                @endif

            </div>
        </div>
        @endforeach
    </div>

    @endforeach
    @endif

    @endsection

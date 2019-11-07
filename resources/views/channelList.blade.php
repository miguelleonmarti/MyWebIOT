@extends('common')

@section('title', 'Channel List')

@section('body')

@if (auth()->check())
<a type="button" class="btn btn-primary" href="newChannel" id="newChannelButton">Crear canal
</a>@endif
<div class="text-center login-dark" id="channelListHeader">
    <header class="border rounded">
        <h3>Listado de todos los canales dados de alta por el usuario</h3>
    </header>
    <section>
        @if (isset($canales))
        @foreach ($canales as $canal)
        <article class="border rounded border-dark" style="margin-bottom: 10px;">
            <header>
            <h4 class="text-center d-inline-flex justify-content-xl-start" style="margin-bottom: 0;">Información sobre el canal "{{ $canal->nombreCanal }}"</h4>
            @if (auth()->check())
            <form action="channelList/{{ $canal->id }}" method="POST" style="all:unset;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger border rounded float-right" type="submit">
                    <i class="material-icons d-xl-flex justify-content-xl-center" style="color: rgb(255,255,255);">delete</i>
                </button>
            </form>
            @endif
            </header>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Descripción: {{ $canal->descripcion }}</p>
            <p class="text-left" style="margin: 10px;margin-bottom: 10px;">Fecha: {{ $canal->created_at }}<br></p>
            <a href="/chart/{{ $canal->id }}">Representación gráfica de los datos almacenados</a>
        </article>
        @endforeach
        @endif
    </section>
</div>

@endsection

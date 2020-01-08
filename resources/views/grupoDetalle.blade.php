@extends('common')

@section('title', 'Detalle de Grupo')

@section('body')

@php
use App\User;
@endphp

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Usuarios del grupo: {{ $grupo->nombre }}</div>
                <div class="card-body">
                    @foreach ($usuarios as $usuario)
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 style="display: inline;">{{ User::where('id', $usuario->id_usuario)->first()->email }}</h3>
                        <form style="display: inline;" class="float-right" action="/eliminarInvitado/{{ $usuario->id_grupo }}/{{ $usuario->id_usuario }}"
                                method="get">
                                <button class="btn btn-danger" type="submit">Eliminar usario del grupo</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

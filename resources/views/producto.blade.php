@extends('common')

@section('title', 'Update Product')

@section('body')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="d-xl-flex login-dark" id="newChannelDiv">
<form action="/productUpdate/{{ $producto->id }}" class="text-center border rounded" method="POST" id="form">
        @csrf
        @method('PUT')
        <i class="material-icons">add_circle_outline</i>
        <div class="form-group">
        <input class="form-control" type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="auto" id="descripcion" name="descripcion" required>{{ $producto->descripcion }}</textarea>
        </div>
        <div class="form-group">
                <input class="form-control" min="0" type="number" id="cantidad" name="cantidad" value="{{ $producto->cantidad }}" required>
            </div>
        <div class="form-group">
            <input class="form-control" type="text" id="precio" name="precio" value="{{ $producto->precio }}" required>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary btn-block" type="submit" id="createChannelButton">Actualizar</button>
        </div>
        <a class="forgot" href="#">You already have an account? Log in here.</a>
    </form>
</div>

@endsection

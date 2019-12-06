@extends('common')

@section('title', 'Friends')

@section('body')

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Seguidores</h3>
                </div>
                <div class="card-body">
                    @foreach ($followers as $follower)
                    <div class="card">
                        <div class="card-header">
                            <p>{{ $follower->follower }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Seguidos</h3>
                </div>
                <div class="card-body">
                        @foreach ($followings as $following)
                        <div class="card">
                            <div class="card-header">
                                <p>{{ $following->following }}</p>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

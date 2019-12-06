@extends('common')

@section('title', 'Friends')

@section('body')

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Miembros</div>
                @foreach ($members as $member)
                <div class="card">
                    <div class="card-body mt-auto">

                        {{ $member->email }}

                        @if (in_array($member->email, $followers))

                        <i>(Te sigue)</i>

                        @else

                        <i>(No te sigue)</i>

                        @endif

                        @if (in_array($member->email, $followings))

                        <form action="/unfollow/{{$member->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger float-right">Unfollow</button>
                        </form>

                        @else

                        <form action="/follow/{{$member->id}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary float-right">Follow</button>
                        </form>

                        @endif

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

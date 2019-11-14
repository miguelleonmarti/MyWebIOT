@extends('common')

@section('title', 'Chart')

@section('links')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endsection

@section('body')

@if($chart && $nombreCanal)
<h2 style="width:100%; text-align: center;">{{ $nombreCanal }}</h2>
<div style="width: 100%; height: 70vh;">
    {!! $chart->container() !!}
</div>

{!! $chart->script() !!}
@endif

<script>
    function refresh() {
        var url = document.URL;
        var id = url.substr(url.lastIndexOf('/') + 1);
        {{ $chart->id }}_refresh(`/refresh/${id}`);
        setTimeout(refresh, 5000);
    }

    refresh();
</script>

@endsection

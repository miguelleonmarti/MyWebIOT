@extends('common')

@section('title', 'Members channels')

@section('links')

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    function getChannels() {

        $.ajax({
            type:'POST',
            url:'/membersChannels',
            data:{'_token' : '{{ csrf_token() }}', 'email' : $("#select").val()},
            success:function(data) {
                let content = '';
                console.log(data.channels);
                data.channels.forEach(element => {
                    content += `<div class="card mb-3">
                        <div class="card-body">
                            <h2><a href="/chart/${element.id}">${element.nombreCanal}</a></h2>
                        </div>
                    </div>`;
                });
                $('#channels').html(content);
            }
        });
    };

</script>

@endsection

@section('body')

<div class="container mt-3 mb-3">

    <div class="row">
        <div class="col">

            <div class="card mt-3">
                <div class="card-header">Mis canales</div>
                <div class="card-body">

                    @foreach ($channels as $channel)

                    <div class="card mb-3">
                        <div class="card-body">
                            <h2><a href="/chart/{{ $channel->id }}">{{ $channel->nombreCanal }}</a></h2>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col">

            <select id="select" name="selected" class="form-control">
                <option value="" selected>Canales de ...</option>
                @foreach ($followings as $following)
                <option value="{{ $following }}" onclick="getChannels()">{{ $following }}</option>
                @endforeach
            </select>

            <div class="card mt-3">
                <div class="card-header">Canales</div>
                <div class="card-body" id="channels">

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

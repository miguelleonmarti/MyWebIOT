@extends('common')

@section('title', 'Social')

@section('links')

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    function getMessages() {
        $.ajax({
            type:'POST',
            url:'/social',
            data:{'_token' : '{{ csrf_token() }}'},
            success:function(data) {
                let content = '';
                console.log(data.mensajes);

                data.mensajes.forEach(message => {
                        if (message.privado == 1)
                            content += '<i class="material-icons" style="display: inline;">lock_outline</i>';

                            content += '<h6 style="display: inline;"><strong>' + message.emisor + ' >>> ' + message.receptor + '</strong></h6></br>';
                            content +=  '<p><i>"' + message.texto + '" a las ' + message.created_at + '</i></p>';
                    });
                $('#messages').html(content);

            }
        });

        setTimeout(getMessages, 2000); // cada 2 segundos obtengo todos los mensajes
    }

    getMessages();

</script>

@endsection

@section('body')

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">Mi perfil</div>
                <div class="card-body">
                    <img class="rounded-circle m-auto" src="{{ $user->imagen }}" alt="No tienes imagen de perfil" width="100" height="100">
                    <h5 class="card-title">Mi nombre</h5>
                    <p class="card-text">{{ $user->nombre }}</p>
                    <h5 class="card-title">Mi estado</h5>
                    <p class="card-text">{{ $user->estado }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <a href="/members" role="button" class="btn btn-outline-primary btn-lg btn-block">Miembros</a>
            <a href="/friends" role="button" class="btn btn-outline-primary btn-lg btn-block">Amigos</a>
            <a href="/newMessage" role="button" class="btn btn-outline-primary btn-lg btn-block">Mensajes</a>
            <a href="/membersChannels" role="button" class="btn btn-outline-primary btn-lg btn-block">Canales</a>
            <a href="/profile" role="button" class="btn btn-outline-primary btn-lg btn-block">Perfil</a>
            <a href="/grupos" role="button" class="btn btn-outline-primary btn-lg btn-block">Grupos</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">Muro de MiWebIoT</div>
                <div class="card-body" id="messages">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

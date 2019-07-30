@extends('frontLayout.master')

@section('content')
<div class="col-md-9">
    <div class="page-head">
            <h3 class="m-b-less">
                Nombre de la sala: {{ $room->name }}
            </h3>
    </div>

    <div class="panel panel-primary">
        <div >
            <div class="panel-body" id="div-chat">
                <ul class="chat">
                    @foreach ($room->messages as $message)
                        <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="{{ $message->user->profile_picture }}" alt="{{ $message->user->full_name }}" class="img-circle" style="width: 50px"/>
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">{{ $message->user->full_name }}</strong> 
                                    <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span>{{ $message->formattedDate() }}</small>
                                </div>
                                <p>
                                {{ $message->message }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="panel-footer">
                <br>
                {!! Form::open(['url' => "/chat/enviar-mensaje/{$room->id}", 'type' => 'POST', 'id' => 'chat-form', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <input autocomplete="off" autofocus name="message" id="message" type="text" class="form-control pull-left" placeholder="Escribe un mensaje aquí..." style="width: 90%">
                        <button class="btn btn-primary btn-md pull-right" style="width: 10%">
                            Enviar
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="page-head">
        <a href="url('#').'" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#document">Adjuntar documentos</a>
    </div>
    <div class="panel panel-primary">
        <div>
            <div class="panel-body">
                <ul class="list-group">
                    @if($room->files->count() > 0)    
                        @foreach($room->files as $file)
                        <li class="list-group-item">
                            <a href="{{ $file->name }}" target="_blank">{{ substr($file->name, 17)}}</a>
                        </li>
                        @endforeach
                    @else
                        <p class="text-center">Sin archivos adjuntos.</p>
                    @endif     
                </ul>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          {!! Form::open(['id' => 'docs-form', 'files' => 'true']) !!}
              <div class="modal-header" style="background: #4e8eba; border-bottom: 5px solid #70b3e0;">
                <h5 class="modal-title" id="exampleModalLabel">Adjunte archivo</h5>
              </div>

              <div class="modal-body">
                  <div class="alert alert-danger validation hidden">
                      <ul></ul>
                  </div>
                <div class="form-group col-md-12 body-modal">
                    <div class="col-sm-3 col-md-3 col-lg-3">
                       {!! Form::label('document', 'Archivo', ['class' => 'control-label']) !!} 
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        {!! Form::file('document', ['class' => 'form-control m-b-10', 'id' => 'file']) !!}
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                {!! Form::submit('Adjuntar', ['class' => 'btn btn-primary']) !!}
              </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <div class="btn-finish">
        <button type="button" id="cerrar-negocio" class="btn btn-md btn-danger col-md-12">Cerrar negocio</button>
    </div>
</div>    
@endsection

@section('styles')
    <style>
        .btn-finish
        {
            margin-top: 30px !important;
            margin-bottom: 10% !important;
        }
        .body-modal
        {
            margin-top: 50px !important;
        }
        .modal-body 
        {
            padding: 10px 15px !important;
        }
        .chat
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li
        {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li.left .chat-body
        {
            margin-left: 60px;
        }

        .chat li.right .chat-body
        {
            margin-right: 60px;
        }


        .chat li .chat-body p
        {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon
        {
            margin-right: 5px;
        }

        .panel-body
        {
            overflow-y: scroll;
            height: 400px;
        }

        ::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
        .body-modal
        {
            margin-top: 50px !important;
        }
        .modal-body 
        {
            padding: 10px 15px !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var room_id = '{{ $room->id }}';
            var quantity = '{{ $room->messages->count() }}';

            (function getMessages() {
                $.ajax({
                    url: '/chat/mensajes/' + room_id, 
                    success: function (data) {
                        if (quantity != data['quantity']) {
                            $('.chat').empty();
                            var messages = '';
                            $.each(data['messages'], function(key, value) {
                                var d = new Date(value['created_at']);
                                var formatted_date =
                                    ("00" + d.getDate()).slice(-2) + "/" +
                                    ("00" + (d.getMonth() + 1)).slice(-2) + "/" +   
                                    d.getFullYear() + " " + 
                                    ("00" + d.getHours()).slice(-2) + ":" + 
                                    ("00" + d.getMinutes()).slice(-2);
                                
                                messages += '<li class="left clearfix"><span class="chat-img pull-left"><img style="width: 50px" src="'+value['user']['profile_picture']+'" alt="'+value['user']['full_name']+'" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+value['user']['full_name']+'</strong> <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>'+formatted_date+'</small></div><p>'+value['message']+'</p></div></li>';
                            });
                            $('.chat').append(messages);
                            $('#div-chat').scrollTop($('#div-chat')[0].scrollHeight - $('#div-chat')[0].clientHeight);
                            quantity = data['quantity'];
                        }
                    },
                    complete: function () {
                        setTimeout(getMessages, 3000);
                    }
                });
            })();
           
            $('#div-chat').scrollTop($('#div-chat')[0].scrollHeight - $('#div-chat')[0].clientHeight);
        
            $('#chat-form').submit(function (event) {
                event.preventDefault();
                $form = $(this);

                if ($('#message').val().trim() != '') {
                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        dataType: 'JSON',
                        success: function (data) { 
                            $('#message').val('');
                        }
                    });
                }
            });

            $('#docs-form').submit(function (event) {
                event.preventDefault();

                var formData = new FormData($('#docs-form')[0]);

                $.ajax({
                    url: '/chat/adjuntar/'+room_id,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.success == true) {
                            $('.validation').empty();
                            $('.validation').addClass('hidden');
                            $('#docs-form').trigger('reset');

                            $('#document').modal('hide');
                            location.reload();
                        } else {
                            var div = $('.validation');
                            var items = '';

                            div.empty();
                            div.removeClass('hidden');
                            div.html('<strong>Se encontraron los siguientes errores: </strong>');

                            $.each(data, function (key, val) {
                                items += '<li id="error_' + key + '">' + val + '</li>';
                            });

                            div.append(items);
                        }
                    }
                });
            });

            $('#file').fileinput({
                theme: 'explorer',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'xls', 'pdf', 'jpeg'],
                showUpload: false,
                showRemove: false,
                browseLabel: 'Seleccionar'
            });

            $('#cerrar-negocio').click(function () {
                if (confirm('¿Cerrar negocio?')) {
                    window.location.href = '{{ url("negocio/cerrar/{$room->deal->id}") }}';
                }
            });
        });
    </script>
@endsection
@extends('frontLayout.master')

@section('content')
    <div class="col-md-9">
        <div class="page-head">
            <h3 class="m-b-less">
                Nombre de la sala: {{ $deal->room->name }}
            </h3>
        </div>

        <div class="panel panel-primary">
            <div >
                <div class="panel-body" id="div-chat">
                    <ul class="chat">
                        @foreach ($deal->room->messages as $message)
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
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div>
                <div class="panel-body">
                    <ul class="list-group">
                        @if($deal->room->files->count() > 0)
                            @foreach($deal->room->files as $file)
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
            $('#div-chat').scrollTop($('#div-chat')[0].scrollHeight - $('#div-chat')[0].clientHeight);
        });
    </script>
@endsection
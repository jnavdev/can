@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Editar Negocio
        </h3>
    </div>
              
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Formulario
                    </header>
                    <div class="panel-body">
                        {!! Form::model($deal, ['url' => 'negocio/editar/' . $deal->id, 'method' => 'PUT', 'class' => 'form-horizontal tasi-form', 'id' => 'form-nuevo-negocio', 'files' => true]) !!}
                            @include('partials.errors')
                            <div class="form-group">
                                {!! Form::label('date', 'Fecha', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('date', Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control m-b-10', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('title', 'Título del negocio', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('title', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Título asignado al negocio']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('client_id', 'Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="client_id" id="client_id" placeholder="Buscar por nombre o rut..." value="{{ $deal->client->full_name . ' - ' . $deal->client->rut }}">
                                </div>
                            </div>

                            <header class="panel-heading">
                                Chat
                            </header>

                            <br>

                            {!! Form::hidden('room_id', $deal->room->id) !!}

                            <div class="form-group">
                                {!! Form::label('room_name', 'Nombre del chat', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('room_name', $deal->room->name, ['class' => 'form-control m-b-10', 'placeholder' => 'Nombre asignado al chat']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('room_description', 'Breve descripción', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('room_description', $deal->room->description, ['class' => 'form-control m-b-10', 'placeholder' => 'Breve descripción del chat']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('room_users', 'Participantes', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select name="room_users[]" class="form-control m-b-10" multiple="multiple" id="room_users">
                                        @foreach ($users as $user)
                                            @if (in_array($user->id, $roomUsers))
                                                <option value="{{ $user->id }}" selected="true">{{ $user->full_name }}</option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endif 
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="pull-right" style="margin-right: 15px;">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>  
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#room_users').select2();

            $('#files').fileinput({
                theme: 'explorer',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'xls', 'pdf', 'jpeg'],
                showUpload: false,
                showRemove: false,
                browseLabel: 'Seleccionar'
            });

            $("#client_id").autocomplete({
                source : '{{ url('negocio/buscar') }}',
            });
        });
    </script>
@endsection
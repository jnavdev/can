@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Mis datos
        </h3>
    </div>
              
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <br>
                            @include('partials.success')
                    </header>
                    <div class="panel-body">
                        {!! Form::model($user, ['url' => 'perfil/foto/' . $user->id, 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                            @include('partials.errors')
                            <div class="form-group">
                                {!! Form::label('full_name', 'Nombre', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('full_name', null, ['class' => 'form-control m-b-10', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::hidden('id', null, ['class' => 'form-control m-b-10']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('file', 'Foto', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::file('file', ['class' => 'form-control m-b-10', 'id' => 'file']) !!}
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                {!! Form::label('password', 'Contraseña', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::password('password', ['class' => 'form-control m-b-10', 'id' => 'password', 'placeholder' => 'Contraseña']) !!}
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
            $('#file').fileinput({
                theme: 'explorer',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'xls', 'pdf', 'jpeg'],
                showUpload: false,
                showRemove: false,
                browseLabel: 'Seleccionar'
            });
        });
    </script>
@endsection
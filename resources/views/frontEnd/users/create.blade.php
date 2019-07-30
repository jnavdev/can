@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Usuario
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
                        {!! Form::open(['url' => 'crear-usuario', 'method' => 'POST', 'class' => 'form-horizontal tasi-form','files' => true]) !!}
                            @include('partials.errors')

                            <div class="form-group">
                                {!! Form::label('rut', 'Rut del Usuario', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('rut', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Rut']) !!}
                                </div>
                            </div>

                             <div class="form-group">
                                {!! Form::label('full_name', 'Nombre de Usuario', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('full_name', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Nombre de Usuario']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Correo electrónico', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('email', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Correo Electrónico']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Contraseña', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::password('password',  ['class' => 'form-control m-b-10','placeholder' => 'Contraseña']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('role_id', 'Rol de Usuario', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                     {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('profile_picture', 'Foto', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::file('profile_picture', ['class' => 'form-control m-b-10', 'id' => 'file']) !!}
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
        $('#rut').Rut({
            on_error: function () {
                alert('¡RUT incorrecto!');
            }
        });
    </script>
@endsection
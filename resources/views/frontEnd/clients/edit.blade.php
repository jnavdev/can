@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Cliente
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
                        {!! Form::model($client, ['url' => 'cliente/editar/' . $client->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                            @include('partials.errors')

                            <div class="form-group">
                                {!! Form::label('rut', 'Rut del Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('rut', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Rut unico de cliente']) !!}
                                </div>
                            </div>

                             <div class="form-group">
                                {!! Form::label('full_name', 'Nombre de Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('full_name', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Nombre de cliente']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('address', 'Dirección comercial de Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('address', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Dirección comercial de cliente']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('activity', 'Actividad comercial de Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('activity', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Actividad comercial de cliente']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('payment_method_id', 'Método de Pago', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::select('payment_method_id', $paymentMethods, null, ['class' => 'form-control m-b-10', 'placeholder' => 'Seleccione']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('observation', 'Observación sobre Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::textarea('observation', null, ['class' => 'form-control m-b-10', 'placeholder' => 'Observación', 'rows' => 4, 'style' => 'resize: none']) !!}
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
        $('#rut').Rut({
            on_error: function () {
                alert('¡RUT incorrecto!');
            }
        });
    </script>
@endsection
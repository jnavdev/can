@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Cotizacion Simple
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
                        {!! Form::open(['url' => 'cotizacion-simple', 'method' => 'POST', 'class' => 'form-horizontal tasi-form', 'id' => 'form-cotizacion-simple', 'files' => true]) !!}
                            @include('partials.errors')
                            <div class="form-group">
                                {!! Form::label('date', 'Fecha cotización', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::text('dte', Carbon\Carbon::now()->format('d-m-Y'), ['class' => 'form-control m-b-10', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('client_id', 'Cliente', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="text" class="form-control" name="client_id" id="client_id" placeholder="Buscar por nombre o rut...">
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('files', 'Documentación', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::file('files[]', ['class' => 'form-control m-b-10', 'multiple' => 'multiple', 'id' => 'files']) !!}
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
            $('#files').fileinput({
                theme: 'explorer',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'xls', 'pdf', 'jpeg'],
                showUpload: false,
                showRemove: false,
                browseLabel: 'Seleccionar'
            });

            $("#client_id").autocomplete({
                source : '{{ url('negocio/buscar') }}'
            });
        });
    </script>
@endsection
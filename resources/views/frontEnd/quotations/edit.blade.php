@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Editar cotización
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
                        {!! Form::model($quotation, ['url' => 'cotizacion-simple/editar/' . $quotation->id, 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
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
                                    <input type="text" class="form-control" value="{{ $client->full_name }} - {{ $client->rut }}" name="client_id" id="client_id" placeholder="Buscar por nombre o rut...">
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
            $("#client_id").autocomplete({
                source : '{{ url('negocio/buscar') }}'
            });

            $('#files').fileinput({
                theme: 'explorer',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'xls', 'pdf', 'jpeg'],
                showUpload: false,
                showRemove: false,
                browseLabel: 'Seleccionar'
            });
        });
    </script>
@endsection
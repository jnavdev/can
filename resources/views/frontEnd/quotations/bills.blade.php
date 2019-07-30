@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Factura
        </h3>
    </div>
              
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Formulario para asociar órden de compra y/o factura
                    </header>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'cotizacion/factura/' . $quotation->id, 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
                            @include('partials.errors')

                            <div class="form-group">
                                {!! Form::label('purchases', 'Archivos de la órden de compra', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::file('purchases[]', ['class' => 'form-control m-b-10', 'multiple' => 'multiple', 'id' => 'purchases']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('bills', 'Archivos de la factura', ['class' => 'control-label col-sm-3 col-md-3 col-lg-3']) !!}
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    {!! Form::file('bills[]', ['class' => 'form-control m-b-10', 'multiple' => 'multiple', 'id' => 'bills']) !!}
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
            $('#bills, #purchases').fileinput({
                theme: 'explorer',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'xls', 'pdf', 'jpeg', 'doc', 'docx', 'txt'],
                showUpload: false,
                showRemove: false,
                browseLabel: 'Seleccionar'
            });
        });
    </script>
@endsection
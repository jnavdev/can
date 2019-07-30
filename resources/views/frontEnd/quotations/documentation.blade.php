@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Documentación
        </h3>
    </div>
              
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Documentos de la cotización
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @if ($quotation->files->count() > 0)
                                <ul>
                                    @foreach ($quotation->files as $file)
                                        <li><a download href="{{ $file->name }}">{{ $file->name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>No hay archivos!</h4>
                            @endif
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Órden de compra
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @if ($quotation->purchases->count() > 0)
                                <ul>
                                    @foreach ($quotation->purchases as $purchase)
                                        <li><a download href="{{ $purchase->name }}">{{ $purchase->name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>No hay archivos!</h4>
                            @endif
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Documentos de la factura
                    </header>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @if ($quotation->bills->count() > 0)
                                <ul>
                                    @foreach ($quotation->bills as $bill)
                                        <li><a download href="{{ $bill->name }}">{{ $bill->name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>No hay archivos!</h4>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
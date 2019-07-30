@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Cotizaciones Vigentes
            <a href="{{ url('cotizacion-simple') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo</a>
        </h3>
    </div>

    <div class="table table-responsive">
        <br>
        @include('partials.success')
        <div class="alert alert-success hidden" id="div-success"></div>
        <table class="table table-bordered table-striped table-hover" id="table">
            <thead>
                <tr>
                    <th>Rut</th>                    
                    <th>Nombre</th>
                    <th>Método de pago</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var table =  $('#table').DataTable({
                language: {
                    url: '{{ asset('assets/frontEnd/js/data-table/es.json') }}'
                },
                processing: true,
                serverSide: true,
                ajax: '{{ url('cotizaciones/dataValid') }}',
                columns: [
                    {data: 'client.rut', name: 'client.rut'},
                    {data: 'client.full_name', name: 'client.full_name'},
                    {data: 'client.payment_method.name', name: 'client.payment_method.name'},
                    {data: 'state', name: 'state'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}

                ]
            });

        });
    </script>
@endsection
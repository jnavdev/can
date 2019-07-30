@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Clientes
            <a href="{{ url('crear-cliente') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo</a>
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
                    <th>Forma de pago</th>
                    <th>Dirección</th>
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
                ajax: '{{ url('clientes/datos') }}',
                columns: [
                    {data: 'rut', name: 'rut'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'payment_method.name', name: 'payment_method.name'},
                    {data: 'address', name: 'address'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });

            $('#table').on('click', '.delete-client', function () {
                if (confirm('¿Eliminar registro?')) {
                    $.get('/eliminar-cliente/' + $(this).data('id'), function () {
                        $('#div-success').html('<strong>Eliminado con éxito!</strong>');
                        $('#div-success').removeClass('hidden');
                        table.draw();
                    });
                }
            });
        });
    </script>
@endsection
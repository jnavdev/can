@extends('frontLayout.master')

@section('content')
    <div class="page-head">
        <h3 class="m-b-less">
            Negocios Cerrados
            <a href="{{ url('nuevo-negocio') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo</a>
        </h3>
    </div>

    <div class="table table-responsive">
        <br>
        @include('partials.success')
        <div class="alert alert-success hidden" id="div-success"></div>
        <table class="table table-bordered table-striped table-hover" id="table">
            <thead>
            <tr>
                <th>Creador</th>
                <th>Cliente</th>
                <th>Estado negocio</th>
                <th>Chat</th>
                <th>Fecha creación</th>
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
                ajax: '{{ url('negocios/dataClosed') }}',
                columns: [
                    {data: 'creator.full_name', name: 'creator.full_name'},
                    {data: 'client.full_name', name: 'client.full_name'},
                    {data: 'deal_state.name', name: 'deal_state.name'},
                    {data: 'room.name', name: 'room.name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });

            $('#table').on('click', '.delete-deal', function () {
                if (confirm('¿Eliminar registro?')) {
                    $.get('/eliminar-negocio/' + $(this).data('id'), function () {
                        $('#div-success').html('<strong>Eliminado con éxito!</strong>');
                        $('#div-success').removeClass('hidden');
                        table.draw();
                    });
                }
            });
        });
    </script>
@endsection
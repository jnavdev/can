@extends('frontLayout.master')
@section('content')
          <div class="page-head">
            <h3 class="m-b-less">
                Usuarios
                <a href="{{ url('crear-usuario') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo</a>
            </h3>
        </div>
        <div>
        @include('partials.success')
            <br>
        </div>

        <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tbluser">
            <thead>
                <tr>
                    <th>ID</th>     
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
@endsection


@section('scripts')
    <script>
        $(function () {
            var table =  $('#tbluser').DataTable({
                language: {
                    url: '{{ asset('assets/frontEnd/js/data-table/es.json') }}'
                },
                processing: true,
                serverSide: true,
                ajax: '{{ url('usuarios/datos') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'rut', name: 'rut'},
                    {data: 'role.name', name: 'role.name'},
                    {data: 'email', name: 'email'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ]
            });

            $('#tbluser').on('click', '.delete-user', function () {
                if (confirm('¿Eliminar registro?')) {
                    $.get('/eliminar-usuario/' + $(this).data('id'), function () {
                        $('#div-success').html('<strong>Eliminado con éxito!</strong>');
                        $('#div-success').removeClass('hidden');
                        table.draw();
                    });
                }
            });
        });
    </script>
@endsection
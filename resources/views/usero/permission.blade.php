@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administración de Permisos</h1>
@stop

@section('content')
    <div class="card-header">
        <a href="{{ route('permissions.create') }}" class="btn btn-primary" data-toggle="modal" data-target="#modalPurple">Registrar Permiso</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tusero">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td width="15px"><a href="{{ route('permissions.edit', $permission) }}"
                                    class="btn btn-primary btn-sm">Editar</a></td>
                            <td width="15px">
                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nuevo Permiso" theme="primary" icon="fas fa-bolt" size='lg'
        disable-animations>
        <form action="{{route('permissions.store')}}" method="POST">
            @csrf
            <div class="row">
                <x-adminlte-input name="name" label="Nombre del Permiso" placeholder="Ingresa nombre"
                    fgroup-class="col-md-6" disable-feedback/>
            </div>
            <x-adminlte-button type="submit" label="Registrar" theme="primary" icon="fas fa-key"/>
        </form>
    </x-adminlte-modal>


@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#tusero').DataTable();
        });
    </script>
@stop

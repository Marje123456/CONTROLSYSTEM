@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-universal-access"></i> Lista de Roles</h1>
@stop

@section('content')
    <div class="card-header">
        <a href="{{ route('roles.create') }}" class="btn btn-info" data-toggle="modal" data-target="#modalPurple">Registrar Rol</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tusero">
                <thead>
                    <tr>
                        <th width="100px">Id</th>
                        <th width="100px">Nombre</th>
                        <th width="100px"></th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td><a href="{{ route('roles.edit', $role) }}" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i> Editar</a></td>
                            <td>
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="form-delete">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nuevo Rol" theme="primary" icon="fas fa-bolt" size='lg'
        disable-animations>
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div class="row">
                <x-adminlte-input name="name" label="Nombre del Rol" placeholder="Ingresa nombre"
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


{{-- Secction SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@switch(true)
    @case(session('delete') == 'OK')
        <script>
            Swal.fire({
                title: "Rol Eliminado!",
                text: "El Rol se ha eliminado Exitosamente",
                icon: "success"
            });
        </script>
    @break

    @case(session('store') == 'OK')
        <script>
            Swal.fire({
                title: "Rol Registrado!",
                text: "El Rol se ha Registrado Exitosamente",
                icon: "success"
            });
        </script>
    @break

    @case(session('edit') == 'OK')
        <script>
            Swal.fire({
                title: "Permisos del Rol Modificados!",
                text: "Los Permisos del Rol se han Modificado Exitosamente",
                icon: "success"
            });
        </script>
    @break

    @default
@endswitch


<script>
    $('.form-delete').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Estás a punto de eliminar un Registro. Esta acción no se podrá revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    })
</script>
@stop

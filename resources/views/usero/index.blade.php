@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <h1><i class="fas fa-solid fa-users"></i> Lista de Usuarios</h1>
@stop

@section('content')


<div class="card-header">
    <a href="{{route('usero.create')}}" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Nuevo Usuario</a>
</div>


    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tusero">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Rol</th>
                        <th width="100px"></th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($useros as $usero)
                        <tr>
                            <td>{{$usero->name}}</td>
                            <td>{{$usero->email}}</td>
                            <td>
                                @if(!empty($usero->getRoleNames()))
                                    @foreach($usero->getRoleNames() as $v)
                                        {{ $v }}
                                    @endforeach
                                 @endif

                            </td>
                            <td>
                                
                                {{-- @can('editar_rol_usuario') --}}
                                <a href="{{route('usero.edit',$usero)}}" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i>  Rol</a>
                               {{--  @endcan --}}
                            </td>    
                            <td>  
                                <form action="{{route('usero.destroy',$usero)}}" method="POST" class="form-delete">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" value="Eliminar" class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i></button>
                                    {{-- <input type="submit" value="Eliminar" class="btn btn-danger btn-sm"> --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready( function () {
    $('#tusero').DataTable();
} );
    </script>

        {{-- Secction SWEETALERT --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        @switch(true)
            @case(session('delete') == 'OK')
                <script>
                    Swal.fire({
                        title: "Usuario Eliminado!",
                        text: "El Usuario se ha eliminado Exitosamente",
                        icon: "success"
                    });
                </script>
            @break
    
            @case(session('store') == 'OK')
                <script>
                    Swal.fire({
                        title: "Usuario Registrado!",
                        text: "El Usuario se ha Registrado Exitosamente",
                        icon: "success"
                    });
                </script>
            @break
    
            @case(session('edit') == 'OK')
                <script>
                    Swal.fire({
                        title: "Role de Usuario Modificado!",
                        text: "El rol del Usuario se han Modificado Exitosamente",
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



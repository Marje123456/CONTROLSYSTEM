@extends('adminlte::page')

@section('title', 'Fiscales')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-nurse"></i>Lista de Fiscales</h1>
@stop

@section('content')
<div class="card-header">
    <a href="{{route('prosecutor.create')}}" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Crear Fiscal</a>
</div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tprosecutors">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Ruta Asignada</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prosecutors as $prosecutor)
                        <tr>
                            <td>{{$prosecutor->idc}}</td>
                            <td>{{$prosecutor->names}}</td>
                            <td>{{$prosecutor->last_names}}</td>
                            <td>{{$prosecutor->phone}}</td>
                            <td>{{$prosecutor->email}}</td>
                            <td></td>
                            <td><a href="{{route('prosecutor.viewitinerary',$prosecutor)}}" class="btn btn-warning btn-sm"><i class="fas fa-solid fa-eye"></i><i class="fas fa-fw fa-route"></i></a></td>
                            <td><a href="{{route('prosecutor.edit',$prosecutor)}}" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{route('prosecutor.destroy',$prosecutor)}}" class="form-delete" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i> </button>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready( function () {
    $('#tprosecutors').DataTable();
} );
    </script>


    {{-- Secction SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @switch(true)
        @case(session('delete') == 'OK')
            <script>
                Swal.fire({
                    title: "Fiscal Eliminado!",
                    text: "El Fiscal se ha eliminado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('store') == 'OK')
            <script>
                Swal.fire({
                    title: "Fiscal Registrado!",
                    text: "El Fiscal se ha Registrado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('edit') == 'OK')
            <script>
                Swal.fire({
                    title: "Fical Modificado!",
                    text: "El Fiscal se ha Modificado Exitosamente",
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

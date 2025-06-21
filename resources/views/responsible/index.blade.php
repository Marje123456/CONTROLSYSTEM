@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-tie"></i>Lista de Representantes de locales</h1>
@stop

@section('content')
<a href="{{ route('responsible.indexpdfresp') }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-solid fa-receipt"></i> Imprimir PDF</a>
@can('registrar_rlm')
<div class="card-header">
    <a href="{{route('responsible.create')}}" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Nuevo Representante</a>
</div>
@endcan
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="myTable" name="myTable">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        @can('pagar_maquina')<th></th>@endcan
                        @can('editaryeliminar_representante')<th ></th>
                        <th ></th>@endcan
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsibles as $responsible)
                        <tr>
                            <td>{{$responsible->idc}}</td>
                            <td>{{$responsible->names}}</td>
                            <td>{{$responsible->last_names}}</td>
                            <td>{{$responsible->phone}}</td>

                            @can('pagar_maquina')
                            <td width="10px"><a href="{{ route('responsible.paymachinesview', $responsible) }}"
                                    class="btn btn-success btn-sm"><i class="fas fa-solid fa-money-bill-wave"></i> Pagar</a></td>
                            @endcan

                            <td width="10px"><a href="{{ route('premise.createt', $responsible) }}"
                                    class="btn btn-warning btn-sm"><i class="fas fa-solid fa-plus"></i><i class="fas fa-solid fa-store"></i></a></td>

                            @can('editaryeliminar_representante')
                            <td><a href="{{route('responsible.edit',$responsible)}}" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i> </a></td>
                            <td>
                                <form action="{{route('responsible.destroy',$responsible)}}" class="form-delete" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i> </button>
                                </form>
                            </td>
                            @endcan
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
    $('#myTable').DataTable();
} );
    </script>


{{-- Secction SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@switch(true)
    @case(session('pay') == 'OK')
        <script>
            Swal.fire({
                title: "¡Pago efectuado!",
                text: "Se ha realizado el pago Exitosamente",
                icon: "success"
            });
        </script>
    @break
    @case(session('delete') == 'OK')
        <script>
            Swal.fire({
                title: "Responsable Eliminado!",
                text: "El Responsable se ha eliminado Exitosamente",
                icon: "success"
            });
        </script>
    @break

    @case(session('store') == 'OK')
        <script>
            Swal.fire({
                title: "Responsable Registrado!",
                text: "El Responsable se ha Registrado Exitosamente",
                icon: "success"
            });
        </script>
    @break

    @case(session('edit') == 'OK')
        <script>
            Swal.fire({
                title: "Responsable Modificado!",
                text: "El Responsable se ha Modificado Exitosamente",
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

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-store"></i> Lista de Locales</h1>
@stop

@section('content')
<a href="{{ route('premise.indexpdfprem') }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-solid fa-receipt"></i> Imprimir PDF</a>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tpremises">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre de Comercio</th>
                        <th>Representate</th>
                        <th>RUT</th>
                        <th>Patente</th>
                        <th>Correo</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Barrio</th>
                        <th></th>
                        @can('editaryeliminar_local')<th></th>
                        <th></th>@endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premises as $premise)
                        <tr>
                            <td>{{ $premise->ident }}</td>
                            <td>{{ $premise->name }}</td>
                            <td>{{ $premise->idc }}</td>
                            <td>{{ $premise->rut }}</td>
                            <td>{{ $premise->patent }}</td>
                            <td>{{ $premise->email }}</td>
                            @foreach ($departments as $department)
                                @if ($premise->department == $department->id)
                                    <td>{{ $department->name }}</td>
                                @endif
                            @endforeach
                            @foreach ($cities as $city)
                                @if ($premise->city == $city->id)
                                    <td>{{ $city->name }}</td>
                                @endif
                            @endforeach
                            @foreach ($neighborhoods as $neighborhood)
                                @if ($premise->neighborhood == $neighborhood->id)
                                    <td>{{ $neighborhood->name }}</td>
                                @endif
                            @endforeach
                            
                            <td width="15px"><a href="{{ route('premise.createqr', $premise) }}" class="btn btn-warning btn-sm"><i class="fas fa-solid fa-qrcode"></i></a></td>

                            @can('editaryeliminar_local')
                            <td width="15px"><a href="{{ route('premise.edit', $premise) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i></a></td>
                            <td width="15px">
                                <form action="{{ route('premise.destroy', $premise) }}" class="form-delete" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i></button>
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
        $(document).ready(function() {
            $('#tpremises').DataTable();
        });
    </script>


    {{-- Secction SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @switch(true)
        @case(session('delete') == 'OK')
            <script>
                Swal.fire({
                    title: "Local Eliminado!",
                    text: "El Local se ha eliminado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('store') == 'OK')
            <script>
                Swal.fire({
                    title: "Local Registrado!",
                    text: "El Local se ha Registrado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('edit') == 'OK')
            <script>
                Swal.fire({
                    title: "Local Modificado!",
                    text: "El Local se ha Modificado Exitosamente",
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

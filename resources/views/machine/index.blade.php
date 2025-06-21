@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-desktop"></i> Lista de Máquinas</h1>
@stop

@section('content')
<a href="{{ route('machine.indexpdfmach') }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-solid fa-receipt"></i> Imprimir PDF</a>
<a href="{{ route('machine.reportgraf') }}" class="btn btn-info btn-sm"><i class="fas fa-solid fa-chart-line"></i> Ver en Gráfica</a>
@can('registrar_rlm')
    {{-- <div class="card-header">
        <a href="{{ route('machine.create') }}" class="btn btn-info"><i class="fas fa-solid fa-laptop-medical"></i> Registrar Máquina</a>
    </div> --}}
@endcan
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tmachines">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Local</th>
                        <th>Serial</th>
                        <th>Fecha de Activación</th>
                        <th>Estatus</th>
                        @can('acciones_maquina')
                        @can('qr_y_estatus')<th></th>@endcan
                        @can('pagos_maquina')<th></th>@endcan
                        @can('editaryeliminar_maquina')<th></th>
                        <th></th>@endcan
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machines as $machine)
                        <tr>
                            <td>{{ $machine->code }}</td>
                            <td>{{ $machine->premise_ident }}</td>
                            <td>{{ $machine->seriale }}</td>
                            <td>{{ $machine->activation_date }}</td>

                            @switch(true)
                                @case($machine->qr_status == 0)
                                    <td>Qr No pago</td>
                                @break

                                @case($machine->qr_status == 1)
                                    <td>Con orden de Impresión</td>
                                @break

                                @case($machine->qr_status == 2)
                                    <td>QR Impreso</td>
                                @break

                                @case($machine->active_status == 0)
                                    <td>Inactiva</td>
                                @break

                                @case($machine->forfeiture_status == 1)
                                    <td>Confiscada</td>
                                @break

                                @case($machine->penalty_status == 1)
                                    <td>Multada</td>
                                @break

                                @case($machine->debit_status == 1)
                                    <td>Deudora</td>
                                @break

                                @case($machine->active_status == 1)
                                    <td>Activa</td>
                                @break

                                @default
                            @endswitch

                            @can('acciones_maquina')
                            @can('qr_y_estatus')
                            @switch(true)
                                @case($machine->qr_status == 0)
                                    <td width="15px"><a href="{{ route('machine.changestatus1', $machine) }}"
                                        class="btn btn-warning btn-sm"><i class="fas fa-solid fa-print"></i> Ordenar Impresión</a></td>
                                    @break
                                @case($machine->qr_status == 1 || $machine->forfeiture_status == 1 || $machine->penalty_status == 1 || $machine->debit_status == 1 || $machine->active_status == 1)
                                    <td width="15px"><a href="{{ route('machine.createqr', $machine) }}"
                                        class="btn btn-warning btn-sm"><i class="fas fa-solid fa-qrcode"></i></a></td>
                                    @break
                                @case($machine->qr_status == 2 || $machine->active_status == 0)
                                    <td width="15px"><a href="{{ route('machine.activatemachine', $machine) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-solid fa-calendar-check"></i> Activar</a></td>
                                @break
                                @default
                            @endswitch
                            @endcan
                            @can('pagos_maquina')
                            <td width="100px"><a href="{{ route('machine.viewpayments', $machine) }}"
                                    class="btn btn-success btn-sm"><i class="fas fa-solid fa-coins"></i> Pagos</a></td>
                            @endcan
                            @can('editaryeliminar_maquina')
                            <td width="15px"><a href="{{ route('machine.edit', $machine) }}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i></a></td>
                            <td width="15px">
                                <form action="{{ route('machine.destroy', $machine) }}" class="form-delete" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                            @endcan
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
            $('#tmachines').DataTable();
        });
    </script>


    {{-- Secction SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @switch(true)
        @case(session('delete') == 'OK')
            <script>
                Swal.fire({
                    title: "¡Máquina Eliminada!",
                    text: "La Máquina se ha eliminado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('storemachine') == 'OK')
            <script>
                Swal.fire({
                    title: "¡Máquina Registrada!",
                    text: "La Máquina se ha Registrado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('editmachine') == 'OK')
            <script>
                Swal.fire({
                    title: "¡Máquina Modificada!",
                    text: "La Máquina se ha Modificado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('mayment') == 'OK')
            <script>
                Swal.fire({
                    title: "¡Pago Registrado!",
                    text: "El Pago se ha Registrado Exitosamente",
                    icon: "success"
                });
            </script>
        @break
        @case(session('itineraryempyt') == 'OK')
            <script>
                Swal.fire({
                    title: "¡No hay locales para asignar!",
                    text: "Todos los locales fueron asignados a una ruta",
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

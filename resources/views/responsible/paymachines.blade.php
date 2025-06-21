@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-desktop"></i> Recibo de cobro N° <b><u>0-00{{ $idreceiptmore }}</u></b></h1>
@stop

@section('content')

    <form id="frmResponsiblepay" name="frmResponsiblepay" method="post" action="{{ route('responsible.ejectpaymachines') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">

                <label for="mounttotalpay">Total a Pagar: </label>
                <input type="text" id="mounttotalpay" name="mounttotalpay" value=" {{ $mounttotalpay }} " readonly>
                <input type="hidden" id="responsible" name="responsible" value=" {{ $responsible->idc }} ">
                <input type="hidden" id="id_receipt" name="id_receipt" value=" {{ $idreceiptmore }} ">
                
                @can('cierre_caja')
                <label for="reference">Referencia de pago: </label>
                <input type="text" id="reference" name="reference" placeholder="">
                <div class="col-md-2">
                    <label for="paymenttype">Tipo de  Pago:</label>
                    <select name="paymenttype" id="paymenttype" class="custom-select">
                        @foreach ($paymentstype as $paymenttype)
                            <option value="{{ $paymenttype->id }}">{{ $paymenttype->nametype }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <br><button type="submit" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Efectuar Pago</button>
                    </div>
                @endcan
                


                
            </div>







        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tmachines">
                <thead>
                    <tr>
                        <th>Local</th>
                        <th>Código</th>
                        <th>Fecha de Activación</th>
                        <th>Fecha de Pago</th>
                        <th>Deuda por activación</th>
                        <th>Monto a pagar</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($machines as $machine)
                        <tr>
                            <td>{{ $machine->premise_ident }}</td>
                            <td>{{ $machine->code }}</td>
                            <td>{{ $machine->activation_date }}</td>
                            <td>{{ date('Y-m-d', strtotime($machine->payment_date)) }}</td>
                            @if (isset($machine->daydebitactivation))
                                <td>{{ $machine->daydebitactivation }} días</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $machine->debitactivation }}</td>
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

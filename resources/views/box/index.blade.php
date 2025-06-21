@extends('adminlte::page')

@section('title', 'Fiscales')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-nurse"></i>Cierres de Caja</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-footer">
                <a href="{{ route('box.indexpdf') }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-solid fa-receipt"></i> Imprimir PDF</a>
            </div>
            <table class="table table-striped" id="tprosecutors">
                <thead>
                    <tr>
                        <th>Fecha de cierre</th>
                        <th>Caja</th>
                        <th>Monto Total</th>
                        <th>Efectivo</th>
                        <th>Transferencia</th>
                        <th>QR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($closeboxs as $closebox)
                        <tr>
                            <td>{{$closebox->close_date}}</td>
                            <td>{{$closebox->userbox}}</td>
                            <td>{{$closebox->total_amount}}</td>
                            <td>{{$closebox->total_cash}}</td>
                            <td>{{$closebox->total_trans}}</td>
                            <td>{{$closebox->total_qr}}</td>
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

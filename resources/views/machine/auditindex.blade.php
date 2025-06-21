@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Máquinas Auditados</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tmachines">
                <thead>
                    <tr>
                        <th>Código Máquina</th>
                        <th>Código Local</th>
                        <th>Fecha de Auditoria</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditmachines as $machine)
                        <tr>
                            <td>{{ $machine->code }}</td>
                            <td>{{ $machine->ident }}</td>
                            <td>{{ $machine->audit_date }}</td>
                            <td>{{ $machine->note }}</td>
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

    @if (session('auditeject') == 'OK')
        <script>
            Swal.fire({
                title: "¡Auditoria Exitosa!",
                text: "La auditoría ha sido registrada exitosamente",
                icon: "success"
            });
        </script>
    @endif



@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Locales Auditados</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tpremises">
                <thead>
                    <tr>
                        <th>Fiscal Auditor</th>
                        <th>Código Local</th>
                        <th>Representate</th>
                        <th>Fecha de Auditoria</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditpremises as $premise)
                        <tr>
                            <td>{{$premise->idc_prosecutor}}</td>
                            <td>{{$premise->ident}}</td>
                            <td>{{$premise->idc_responsible}}</td>
                            <td>{{$premise->audit_date}}</td>
                            <td>{{$premise->note}}</td>
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
    $('#tpremises').DataTable();
} );
    </script>



   {{-- Secction SWEETALERT --}}
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  @switch(true)
      @case(session('auditeject') == 'OK')
      <script>
        Swal.fire({
            title: "¡Auditoria Exitosa!",
            text: "La auditoría ha sido registrada exitosamente",
            icon: "success"
        });
    </script>
          @break
      @case(session('auditeject') == 'NOT')
      <script>
        Swal.fire({
            title: "¡Error!",
            text: "Para auditar debe dirigirse al local",
            icon: "error"
        });
    </script>
          @break
      @default
          
  @endswitch
  
@stop

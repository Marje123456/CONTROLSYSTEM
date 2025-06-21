@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de pagos de la Máquina</h1>
@stop

@section('content')
<div class="card-header">
    {{-- <a href="{{route('machine.payment',$machine)}}" class="btn btn-primary">Registrar Pago</a> --}}
    {{-- <a href="" class="btn btn-primary">Registrar Pago</a> --}}
</div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tpaymachines">
                <thead>
                    <tr>
                        <th>Fecha de Pago</th>
                        <th>Monto</th>
                        <th>Referencia</th>
                        <th>Mes a pagar</th>
                        <th>Año a pagar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machinespayments as $machinepayment)
                        <tr>
                            <td>{{$machinepayment->payment_date}}</td>
                            <td>{{$machinepayment->amount}}</td>
                            <td>{{$machinepayment->reference}}</td>
                            <td>{{$machinepayment->month_pay}}</td>
                            <td>{{$machinepayment->year_pay}}</td>
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
    $('#tpaymachines').DataTable();
} );
    </script>
@stop

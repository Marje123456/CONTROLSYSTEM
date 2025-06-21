@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-tie"></i> Recibo</h1>
@stop

@section('content')


    <div class="content-wrapper">
        <div class="card-footer">
            <a href="{{ route('responsible.receiptpayment', $responsible) }}" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-solid fa-receipt"></i> Imprimir</a>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3><i class="fas fa-solid fa-desktop"></i> Recibo de cobro N°<b><u>0-00{{ $idreceiptconsult->id }}</u></b></h3>
                            </div>


                            
    <form >
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="mounttotalpay"><b>Responsable: </b></label> 
                <label for="mounttotalpay">{{ $responsible->idc }}</label>
                <label for="paymenttype">{{ $responsible->names }} {{ $responsible->last_names }}</label>
            </div>
            <div class="form-group">
                <label for="mounttotalpay"><b>Total a Pagar: </b></label> 
                <label for="mounttotalpay">{{ $receipt->total_amount }}</label>
                <label for="paymenttype"><b>Tipo de  Pago: </b></label>
                <label for="paymenttype">{{ $paymenttype->nametype }}</label>
            </div>
        </div>
    </form>
    
    <div class="card">
        <div class="card-body">
            <h3>Máquinas canceladas</h3>
            <table class="table table-striped" id="tmachines">
                <thead>
                    <tr>
                        <th>Código de máquina </th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machinespayments as $machine)
                        <tr>
                            <td>{{ $machine->code_machine }}</td>
                            <td>{{ $machine->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
                        </div>
                        
                    @stop

                    @section('css')
                        {{-- Add here extra stylesheets --}}
                        {{-- <link rel="stylesheet" href="/css/admin_custom.css">  --}}
                    @stop

                    @section('js')
                        <script>
                            console.log("Hi, I'm using the Laravel-AdminLTE package!");
                        </script>
                    @stop

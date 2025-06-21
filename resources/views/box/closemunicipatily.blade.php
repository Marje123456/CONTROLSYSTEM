@extends('adminlte::page')

@section('title', 'Fiscal')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-nurse"></i> Cierre de Caja</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Cierre de caja para el día {{$date_close_box}} </h3>
                            </div>


                            <form id="frmProsecutor" name="frmProsecutor" method="post" action="{{route('box.closemunipdf')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="close_date">Fecha de Cierre</label>
                                        <input type="text" class="form-control" id="close_date" name="close_date" value="{{$date_close_box}}" readonly>
                                   </div>
                                    <div class="form-group">
                                        <label for="total_amount">Total Recaudado</label>
                                        <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{$total_amount}}" readonly>
                                   </div>
                                    <div class="form-group">
                                        <label for="total_cash">Efectivo</label>
                                        <input type="text" class="form-control" id="total_cash" name="total_cash" value="{{$total_cash}}" readonly>
                                   </div>
                                    <div class="form-group">
                                        <label for="total_trans">Transferencia</label>
                                        <input type="text" class="form-control" id="total_trans" name="total_trans" value="{{$total_trans}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_qr">Qr</label>
                                        <input type="text" class="form-control" id="total_qr" name="total_qr" value="{{$total_QR}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="mount_company">Monto para empresa</label>
                                        <input type="text" class="form-control" id="mount_company" name="mount_company" value="{{$porcent_company}}" readonly>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Efectuar Cierre</button>
                                </div>
                            </form>
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

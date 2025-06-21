@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-tie"></i> Recibo</h1>
@stop

@section('content')


    <div class="content-wrapper">
        <div class="card-footer">
            <form id="frmItinerary" name="frmItinerary" method="post" action="{{ route('box.closemunireceipt') }}" target="_blank">
                @csrf
                <input type="hidden" id="date_close_box" name="date_close_box" value="{{$data['date_close_box']}}">
                <input type="hidden" id="total_amount" name="total_amount" value="{{$data['total_amount']}}">
                <input type="hidden" id="total_cash" name="total_cash" value="{{$data['total_cash']}}">
                <input type="hidden" id="total_trans" name="total_trans" value="{{$data['total_trans']}}">
                <input type="hidden" id="total_QR" name="total_QR" value="{{$data['total_QR']}}">
                <input type="hidden" id="porcent_company" name="porcent_company" value="{{$data['porcent_company']}}">
                <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-receipt"></i> Imprimir</button>    
            </form>
        </div>
        
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Cierre de caja para el día {{$data['date_close_box']}}
                            </div>
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="close_date"><b>Fecha de Cierre: </b></label>
                                        <label for="">{{$data['date_close_box']}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_cash"><b>Efectivo: </b></label>
                                        <label for="">{{$data['total_cash']}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_trans"><b>Transferencia: </b></label>
                                        <label for="">{{$data['total_trans']}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_qr"><b>Qr: </b></label>
                                        <label for="">{{$data['total_QR']}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_amount"><b>Total Recaudado: </b></label>
                                        <label for="">{{$data['total_amount']}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="mount_company"><b>Monto para empresa: </b></label>
                                        <label for="">{{$data['porcent_company']}}</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div></div></div></section>
            
      
        
        

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

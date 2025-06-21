@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestionar Pago de Máquina {{ $machine->code }}</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Datos de Facturación</h3>
                            </div>


                            <form id="frmPayment" name="frmPayment" method="post" action="{{route('machine.paymenteject', $machine)}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="code">Código de la máquina</label>
                                        <input type="text" class="form-control" id="code_machine"
                                            name="code_machine" value="{{ $machine->code }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Monto a pagar</label>
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            placeholder="Ingresa Monto" required pattern="[0-9]+">
                                    </div>
                                    <div class="form-group">
                                        <label for="reference">Código de Referencia</label>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                            placeholder="Ingresa Referencia" required pattern="[0-9]+">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Año</label>
                                        <select name="selectyears" id="selectyears" class="custom-select">
                                            @for ($i = 2020; $i < $year+2; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Meses a Pagar</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="01">
                                                <label for="checkboxPrimary1">Enero</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="02">
                                                <label for="checkboxPrimary1">Febrero</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="03">
                                                <label for="checkboxPrimary1">Marzo</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="04">
                                                <label for="checkboxPrimary1">Abril</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="05">
                                                <label for="checkboxPrimary1">Mayo</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="06">
                                                <label for="checkboxPrimary1">Junio</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="07">
                                                <label for="checkboxPrimary1">Julio</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="08">
                                                <label for="checkboxPrimary1">Agosto</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="09">
                                                <label for="checkboxPrimary1">Septiembre</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="10">
                                                <label for="checkboxPrimary1">Octubre</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="11">
                                                <label for="checkboxPrimary1">Noviembre</label>
                                            </div></br>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="month_pay[]" name="month_pay[]" value="12">
                                                <label for="checkboxPrimary1">Diciembre</label>
                                            </div>
                                        </div>
                                    </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Registrar Pago</button>
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

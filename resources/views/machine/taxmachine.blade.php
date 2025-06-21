@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-desktop"></i> Editar Monto de impuesto por Máquina</h1>
@stop

@section('content')

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de Monto</h3>
                            </div>


                            <form id="frmStatusMachine" name="frmStatusMachine" method="POST"
                                action="{{ route('machine.updatetaxmachine', $statusmachine) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="penalty_days">Monto del impuesto por máquina</label>
                                        <input type="text" class="form-control" id="machine_tax" name="machine_tax"
                                            value="{{ $statusmachine->machine_tax }}" required pattern="[0-9]+">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-check"></i> Actualizar</button>
                                    </div>
                            </form>
                        </div>
                    @stop

                    @section('css')
                       
                    @stop

                    @section('js')
                       
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        @if (session('tax') == 'OK')
                            <script>
                                Swal.fire({
                                    title: "¡Monto editado!",
                                    text: "El monto del impuesto a pagar por máquina se ha Modificado Exitosamente",
                                    icon: "success"
                                });
                            </script>
                        @endif

                       
                    @stop

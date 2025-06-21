@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-desktop"></i> Editar Cambios de Estatus de las Máquinas</h1>
@stop

@section('content')

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de Estatus</h3>
                            </div>


                            <form id="frmStatusMachine" name="frmStatusMachine" method="POST"
                                action="{{ route('machine.updatestatusmachine', $statusmachine) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="penalty_days">Días para cambiar estado a MULTADA (transcurridos desde el día de pago)</label>
                                        <input type="text" class="form-control" id="penalty_days" name="penalty_days"
                                            value="{{ $statusmachine->penalty_days }}" required pattern="[0-9]+">
                                    </div>
                                    <div class="form-group">
                                        <label for="forfeiture_days">Días para cambiar estado a </br> ORDEN DE
                                            CONFISCACIÓN (transcurridos desde el día de pago)</label>
                                        <input type="text" class="form-control" id="forfeiture_days"
                                            name="forfeiture_days" value="{{ $statusmachine->forfeiture_days }}" required
                                            pattern="[0-9]+">
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

                        @if (session('statusdays') == 'OK')
                            <script>
                                Swal.fire({
                                    title: "¡Días Editados!",
                                    text: "Los días para cambio de estatus de han Modificado Exitosamente",
                                    icon: "success"
                                });
                            </script>
                        @endif

                       
                    @stop

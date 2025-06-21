@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-desktop"></i> Editar Datos de la Máquina <u><b>{{ $machine->code }}</b></u></h1>
@stop

@section('content')

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la Máquina</h3>
                            </div>


                            <form id="frmMachine" name="frmMachine" method="POST"
                                action="{{ route('machine.update', $machine) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="premise_ident">Código de la Máquina</label>
                                        <input type="text" class="form-control" id="code" name="code"
                                            value="{{ $machine->code }}" required minlength="2" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="premise_ident">Código del Local</label>
                                        <input type="text" class="form-control" id="premise_ident" name="premise_ident"
                                            value="{{ $machine->premise_ident }}" minlength="2" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_names">Modelo</label>
                                        <input type="text" class="form-control" id="model" name="model"
                                            value="{{ $machine->model }}" minlength="2" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="names">Marca</label>
                                        <input type="text" class="form-control" id="brand" name="brand"
                                            value="{{ $machine->brand }}" minlength="2" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Serial</label>
                                        <input type="text" class="form-control" id="seriale" name="seriale"
                                            value="{{ $machine->seriale }}" required pattern="[0-9]+" minlength="3" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Fecha de Registro</label>
                                        <input type="text" class="form-control" id="registration_date"
                                            name="registration_date" value="{{ $machine->registration_date }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Estado</label>

                                    @if ($machine->active_status == 0)
                                    <input type="text" class="form-control" id="status" name="status"
                                    value="Inactiva" readonly>
                                    @else
                                        @switch(true)
                                            @case($machine->forfeiture_status == 1)
                                            <input type="text" class="form-control" id="status" name="status"
                                            value="Confiscada" readonly>
                                            @break

                                            @case($machine->penalty_status == 1)
                                            <input type="text" class="form-control" id="status" name="status"
                                            value="Multada" readonly>
                                            @break

                                            @case($machine->debit_status == 1)
                                            <input type="text" class="form-control" id="status" name="status"
                                            value="Deudora" readonly>
                                            @break

                                            @case($machine->active_status == 1)
                                            <input type="text" class="form-control" id="status" name="status"
                                            value="Activa" readonly>
                                            @break
                                            @default
                                        @endswitch
                                    @endif
                                        
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-check"></i> Actualizar Datos</button>
                                    </div>
                            </form>
                        </div>
                    @stop

                    @section('css')
                        {{-- Add here extra stylesheets --}}
                        {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
                    @stop

                    @section('js')
                        {{-- Secction SWEETALERT --}}
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


                        @if (session('editmachine') == 'OK')
                            <script>
                                Swal.fire({
                                    title: "¡Registro Modificado!",
                                    text: "La Máquina se ha Modificado exitosamente",
                                    icon: "success"
                                });
                            </script>
                        @endif
                    @stop

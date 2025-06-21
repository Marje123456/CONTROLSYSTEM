@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-tie"></i> Gestionar Representante de Local</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Representante</h3>
                            </div>


                            <form id="frmResponsible" name="frmResponsible" method="post" action="{{route('responsible.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idc">Cédula de Identidad</label>
                                        <input type="text" class="form-control" id="idc" name="idc" placeholder="Ingresa CI"  required pattern="[0-9]+" minlength="6" maxlength="15" >
                                   </div>
                                    <div class="form-group">
                                        <label for="names">Nombre</label>
                                        <input type="text" class="form-control" id="names" name="names" placeholder="Ingresa Nombres"  required minlength="3" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_names">Apellidos</label>
                                        <input type="text" class="form-control" id="last_names" name="last_names" placeholder="Ingresa Apellidos"  required minlength="3" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Teléfono</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingresa Teléfono"  required pattern="[0-9]+" minlength="8" maxlength="20">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Correo</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa Correo" minlength="5" maxlength="50">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Registrar</button>
                                </div>
                            </form>
                        </div>
                    @stop

                    @section('css')
                        {{-- Add here extra stylesheets --}}
                        {{-- <link rel="stylesheet" href="/css/admin_custom.css">  --}}
                    @stop

                    @section('js')
                        {{-- Secction SWEETALERT --}}
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


                        @switch(true)
                            @case(session('emailduplicate') == 'OK')
                                <script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error en Email",
                                        text: "Ya existe un Responsable con ese email!"
                                    });
                                </script>
                            @break
                            @case(session('idcduplicate') == 'OK')
                                <script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error en Cédula",
                                        text: "Ya existe un Responsable con la cédula ingresada!"
                                    });
                                </script>
                            @break

                            @default
                        @endswitch
                    @stop

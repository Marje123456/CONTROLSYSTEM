@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-user-plus"></i> Registrar Usuario</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Usuario</h3>
                            </div>


                            <form id="frmUsero" name="frmUsero" method="post" enctype="multipart/form-data"
                                action="{{ route('usero.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idc">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Ingresa Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="names">Correo Electrónico</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Ingresa Correo Electrónico" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_names">Contraseña</label>
                                        <input type="password" class="form-control" id="pass" name="pass"
                                            placeholder="Ingresa Contraseña" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_names">Foto</label>
                                        <input type="file" name="imagen">
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i>
                                        Registrar</button>
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
                                        text: "Ya existe un ususario con ese email!"
                                    });
                                </script>
                            @break

                            @default
                        @endswitch



                    @stop

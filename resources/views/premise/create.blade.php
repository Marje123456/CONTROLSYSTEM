@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-store"></i> Registrar Local</h1>
@stop

@section('content')
    @livewireScripts

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Local</h3>
                            </div>


                            <form id="frmPremise" name="frmPremise" method="post" action="{{ route('premise.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_itinerary">Responsable</label>
                                        <input type="text" class="form-control" id="idc" name="idc"
                                            value="{{ $responsible->idc }}" readonly>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="last_names">Código</label>
                                        <input type="text" class="form-control" id="ident" name="ident"
                                            placeholder="Ingresa Código con el que se identificará en el sistema" required minlength="2" maxlength="50">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="name">Nombre del Comercio</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Ingresa el nombre del Comercio" minlength="2" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="names">RUC</label>
                                        <input type="text" class="form-control" id="rut" name="rut"
                                            placeholder="Ingresa Rut del Local" minlength="2" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Patente</label>
                                        <input type="text" class="form-control" id="patent" name="patent"
                                            placeholder="Ingresa Patente" minlength="2" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Correo Electrónico</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Ingresa Correo" minlength="3" maxlength="50">
                                    </div>

                                    <livewire:location />

                                    <div class="form-group">
                                        <label for="phone">Dirección</label>
                                        <textarea class="form-control" id="address" name="address" cols="5" rows="5"></textarea>
                                    </div>

                                    {{-- ******************************************************* --}}

                                    <input type="hidden" class="form-control" id="latitude" name="latitude">

                                    <input type="hidden" class="form-control" id="longitude" name="longitude">


                                    <div id="mylocation">

                                    </div>
                                    {{-- ******************************************************* --}}


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-plus"></i>
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
                        <script>
                            navigator.geolocation.getCurrentPosition(succsess, error);

                            function succsess(geolocationPosition) {
                                let coords = geolocationPosition.coords;
                                document.getElementById("latitude").value = coords.latitude;
                                document.getElementById("longitude").value = coords.longitude;
                            }

                            function error(err) {
                                document.getElementById("mylocation").innerHTML = "Debes permitir acceso a la ubicacion de tu dispositivo";
                            }
                        </script>

                        {{-- Secction SWEETALERT --}}
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


                        @switch(true)
                            @case(session('delete') == 'OK')
                                <script>
                                    Swal.fire({
                                        title: "Responsable Eliminado!",
                                        text: "El Responsable se ha eliminado Exitosamente",
                                        icon: "success"
                                    });
                                </script>
                            @break

                            @case(session('store') == 'OK')
                                <script>
                                    Swal.fire({
                                        title: "Responsable Registrado!",
                                        text: "El Responsable se ha Registrado Exitosamente",
                                        icon: "success"
                                    });
                                </script>
                            @break

                            @case(session('edit') == 'OK')
                                <script>
                                    Swal.fire({
                                        title: "Responsable Modificado!",
                                        text: "El Responsable se ha Modificado Exitosamente",
                                        icon: "success"
                                    });
                                </script>
                            @break

                            @case(session('rutunique') == 'OK')
                                <script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error en RUC",
                                        text: "Ya existe un Local con ese RUC!"
                                    });
                                </script>
                            @break

                            @case(session('patentduplicate') == 'OK')
                                <script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error en Patente",
                                        text: "Ya existe un Local con la Patente ingresada!"
                                    });
                                </script>
                            @break

                            @default
                        @endswitch

                    @stop

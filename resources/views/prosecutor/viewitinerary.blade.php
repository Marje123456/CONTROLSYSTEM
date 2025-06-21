@extends('adminlte::page')

@section('title', 'Ver Ruta')

@section('content_header')
    <h1><i class="fas fa-fw fa-regular fa-map"></i> Ver Recorrido asignado para el Fiscal <u><b> {{$prosecutor->names}} {{$prosecutor->last_names}}</b></u></h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Recorrido</h3>
                            </div>


                            <form id="frmItinerary" name="frmItinerary" method="post" action="{{ route('itinerary.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_itinerary">Recorrido Asignado:</label>
                                        <input type="text" class="form-control" id="name_itinerary" name="name_itinerary" value="{{$itineraries->name}}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Locales a Fiscalizar</label>

                                            @foreach ($premiselist as $premise)
                                            
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <label for="checkboxPrimary1">
                                                            {{$premise->ident}} - {{$premise->name}} - {{$premise->address}}
                                                        </label>
                                                    </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="card-footer">
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


                        @if (session('storeitinerary') == 'OK')
                            <script>
                                Swal.fire({
                                    title: "¡Registro Exitoso!",
                                    text: "La ruta se ha registrado exitosamente",
                                    icon: "success"
                                });
                            </script>
                        @endif
                    @stop

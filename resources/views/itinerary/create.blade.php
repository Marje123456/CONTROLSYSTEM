@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-regular fa-map"></i> Gestionar Recorrido</h1>
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


                            <form id="frmItinerary" name="frmItinerary" method="post"
                                action="{{ route('itinerary.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_itinerary">Nombre del Recorrido</label>
                                        <input type="text" class="form-control" id="name_itinerary" name="name_itinerary"
                                            placeholder="Ingresa un Nombre para la ruta" required minlength="1" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="name_itinerary">Fiscal Asignado</label>
                                        <select name="selectprosecutor" id="selectprosecutor" class="custom-select">
                                            @foreach ($prosecutors as $prosecutor)
                                                <option value="{{ $prosecutor['idc'] }}">{{ $prosecutor['names'] }}
                                                    {{ $prosecutor['last_names'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="id_itinerary">Código</label>
                                        <input type="text" class="form-control" id="id_itinerary" name="id_itinerary"
                                            placeholder="Ingresa un Código" required minlength="1" maxlength="6">
                                    </div> --}}

                                    <livewire:location/>
                                    
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Locales</label>

                                            @foreach ($premises as $premise)
                                            
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" id="checkpremise[]" name="checkpremise[]"
                                                            value="{{$premise['ident']}}">
                                                        <label for="checkboxPrimary1">
                                                            {{$premise['ident']}} - {{$premise['address']}}
                                                        </label>
                                                    </div>
                                            @endforeach

                                        </div>
                                    </div> --}}
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-check"></i> Registrar</button>
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

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-regular fa-map"></i> Editar Recorrido</h1>
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
                                action="{{ route('itinerary.update', $itinerary) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_itinerary">Código del Recorrido</label>
                                        <input type="text" class="form-control" id="id_itinerary" name="id_itinerary" value="{{ $itinerary->id_itinerary }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_itinerary">Nombre del Recorrido</label>
                                        <input type="text" class="form-control" id="name_itinerary" name="name_itinerary" value="{{ $itinerary->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Municipio</label>
                                        <input type="text" class="form-control" id="department" name="department" value="{{ $department->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">Ciudad</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $city->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="neighborhood">Barrio</label>
                                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ $neighborhood->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_itinerary">Fiscal Asignado</label>
                                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ $prosecutore->names }} {{ $prosecutore->last_names }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_itinerary">Modificar Fiscal Asignado Por:</label>
                                        <select name="selectprosecutor" id="selectprosecutor" class="custom-select">
                                            @foreach ($prosecutors as $prosecutor)
                                                <option value="{{ $prosecutor['idc'] }}">{{ $prosecutor['names'] }}
                                                    {{ $prosecutor['last_names'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-check"></i> Actualizar Datos</button>
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

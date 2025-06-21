@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-route"></i> Asignar Recorrido</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos</h3>
                            </div>


                            <form id="frmAsignItinerary" name="frmAsignItinerary" method="post"
                                action="{{ route('itinerary.asignitineraryr') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_itinerary">Fiscal</label>
                                        <select name="selectprosecutor" id="selectprosecutor" class="custom-select">
                                            @foreach ($prosecutors as $prosecutor)
                                                <option value="{{ $prosecutor->idc }}">{{ $prosecutor->names }}
                                                    {{ $prosecutor->last_names }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name_itinerary">Recorrido</label>
                                        <select name="selectitinerary" id="selectitinerary" class="custom-select">
                                            @foreach ($itineraries as $itinerary)
                                                <option value="{{ $itinerary->id_itinerary }}">{{ $itinerary->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-fw fa-route"></i> Asignar</button>
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


                        @if (session('asigiti') == 'OK')
                            <script>
                                Swal.fire({
                                    title: "¡Asignación Exitosa!",
                                    text: "La ruta se ha asignado exitosamente",
                                    icon: "success"
                                });
                            </script>
                        @endif
                    @stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-tie"></i> Editar Datos del Representante <u><b>{{$responsible->names}} {{$responsible->lastnames}}</b></u></h1>
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


                            <form id="frmResponsible" name="frmResponsible" method="POST" action="{{route('responsible.update', $responsible)}}">
                                @csrf
                                @method('PUT') 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idc">Cédula de Identidad</label>
                                        <input type="text" class="form-control" id="idc" name="idc" value="{{$responsible->idc}}" required pattern="[0-9]+" minlength="6" maxlength="15">
                                   </div>
                                    <div class="form-group">
                                        <label for="names">Nombre</label>
                                        <input type="text" class="form-control" id="names" name="names" value="{{$responsible->names}}" required minlength="3" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_names">Apellidos</label>
                                        <input type="text" class="form-control" id="last_names" name="last_names" value="{{$responsible->last_names}}" required minlength="3" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Teléfono</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$responsible->phone}}" required minlength="8" maxlength="20">
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-user-plus"></i> Actualizar Datos</button>
                                </div>
                            </form>
                        </div>
                    @stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
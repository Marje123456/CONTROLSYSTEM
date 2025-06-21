@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-fw fa-solid fa-user-nurse"> </i> Datos del Fisal <u><b>{{$prosecutor->names}}  {{$prosecutor->last_names}}</b></u></h1>
@stop

@section('content')

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Fiscal</h3>
                            </div>


                            <form id="frmProsecutor" name="frmProsecutor" method="POST" action="{{route('prosecutor.update', $prosecutor)}}">
                                @csrf
                                @method('PUT') 
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="idc">Cédula de Identidad</label>
                                        <input type="text" class="form-control" id="idc" name="idc" value="{{$prosecutor->idc}}" required pattern="[0-9]+" minlength="6" maxlength="15">
                                   </div>
                                    <div class="form-group">
                                        <label for="names">Nombre</label>
                                        <input type="text" class="form-control" id="names" name="names" value="{{$prosecutor->names}}" required minlength="3" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_names">Apellidos</label>
                                        <input type="text" class="form-control" id="last_names" name="last_names" value="{{$prosecutor->last_names}}" required minlength="3" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Teléfono</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$prosecutor->phone}}" required minlength="8" maxlength="20">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Correo</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{$prosecutor->email}}" minlength="5" maxlength="50">
                                    </div>
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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
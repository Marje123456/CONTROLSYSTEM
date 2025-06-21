@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-user-tag"></i> Editar Rol del Usuario <b><u>{{$usero->name}}</u></b></h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Roles</h3>
                            </div>
                               
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        {!! Form::model($usero, ['route' => ['usero.update', $usero], 'method'=>'put']) !!}
                                        @csrf
                                        @foreach ($roles as $role)
                                        @switch(true)
                                            @case($role->name == 'Administrador' || $role->name == 'Intendente')
                                            @can('configuracion')
                                            <div class="form-group clearfix"> 
                                                {!! Form::checkbox('roles[]', $role->id, $usero->hasAnyRole($role->id) ? : false, ['class'=>'mr1']) !!}
                                                {{$role->name}}
                                            </div>
                                            @endcan
                                                @break
                                            @case($role->name == 'Municipalidad')
                                            @can('cierre_caja')
                                            <div class="form-group clearfix"> 
                                                {!! Form::checkbox('roles[]', $role->id, $usero->hasAnyRole($role->id) ? : false, ['class'=>'mr1']) !!}
                                                {{$role->name}}
                                            </div>
                                            @endcan
                                                @break
                                            @default
                                            <div class="form-group clearfix"> 
                                                {!! Form::checkbox('roles[]', $role->id, $usero->hasAnyRole($role->id) ? : false, ['class'=>'mr1']) !!}
                                                {{$role->name}}
                                            </div>
                                        @endswitch
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {!! Form::submit('Asignar Rol', ['class'=>'btn btn-info']) !!}
                                    {!! Form::close() !!}
                                </div>
                        </div>
                    @stop

                    @section('css')
                        {{-- Add here extra stylesheets --}}
                        {{-- <link rel="stylesheet" href="/css/admin_custom.css">  --}}
                    @stop

                    @section('js')
                        <script>
                            console.log("Hi, I'm using the Laravel-AdminLTE package!");
                        </script>
                    @stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-address-book"></i> Editar permisos para el Rol <u><b>{{$role->name}}</b></u></h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Permisos</h3>
                            </div>

                                <div class="card-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        {!! Form::model($role, ['route' => ['roles.update', $role], 'method'=>'put']) !!}
                                        @csrf
                                        @foreach ($permissions as $permission)
                                        <div class="form-group clearfix">
                                            {!! Form::checkbox('permissions[]', $permission->id, $role->hasPermissionTo($permission->id) ? : false, ['class'=>'mr1']) !!}
                                            {{$permission->name}}
                                        </div>
                                            
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {!! Form::submit('Asignar Permisos', ['class'=>'btn btn-info']) !!}
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

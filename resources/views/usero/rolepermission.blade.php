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
                                        {!! Form::model($role, ['route' => ['roles.update', $role], 'method'=>'put', 'id' => 'permissionsForm']) !!}
                                        @csrf
                                        <div class="form-group clearfix">
                                            <label>
                                                <input type="checkbox" id="selectAll"> <strong>Seleccionar todos</strong>
                                            </label>
                                        </div>
                                        <hr>
                                        @foreach ($permissions as $permission)
                                        <div class="form-group clearfix">
                                            <label>
                                                {!! Form::checkbox('permissions[]', $permission->id, $role->hasPermissionTo($permission->id) ? : false, ['class'=>'mr1 permission-checkbox']) !!}
                                                {{$permission->name}}
                                            </label>
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
                            document.addEventListener('DOMContentLoaded', function() {
                                // Obtener referencias a los elementos
                                const selectAllCheckbox = document.getElementById('selectAll');
                                const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
                                const permissionsForm = document.getElementById('permissionsForm');
                                
                                // Función para verificar si todos los checkboxes están marcados
                                function checkAllChecked() {
                                    const allChecked = Array.from(permissionCheckboxes).every(checkbox => checkbox.checked);
                                    selectAllCheckbox.checked = allChecked;
                                    selectAllCheckbox.indeterminate = !allChecked && Array.from(permissionCheckboxes).some(checkbox => checkbox.checked);
                                }
                                
                                // Evento para el checkbox "Seleccionar todos"
                                selectAllCheckbox.addEventListener('change', function() {
                                    permissionCheckboxes.forEach(checkbox => {
                                        checkbox.checked = this.checked;
                                    });
                                });
                                
                                // Eventos para los checkboxes individuales
                                permissionCheckboxes.forEach(checkbox => {
                                    checkbox.addEventListener('change', checkAllChecked);
                                });
                                
                                // Verificar el estado inicial
                                checkAllChecked();
                                
                                // Prevenir envío del formulario si no hay permisos seleccionados
                                permissionsForm.addEventListener('submit', function(e) {
                                    const anyChecked = Array.from(permissionCheckboxes).some(checkbox => checkbox.checked);
                                    if (!anyChecked) {
                                        e.preventDefault();
                                        alert('Por favor, selecciona al menos un permiso.');
                                    }
                                });
                            });
                        </script>
                    @stop

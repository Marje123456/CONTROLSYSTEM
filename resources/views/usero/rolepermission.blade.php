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
                                    <div class="col-md-12">
                                        {!! Form::model($role, ['route' => ['roles.update', $role], 'method'=>'put', 'id' => 'permissionsForm']) !!}
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                </div>
                                                <input type="text" id="searchPermission" class="form-control" placeholder="Buscar permiso...">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group clearfix mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="selectAll">
                                                <label for="selectAll" class="custom-control-label font-weight-bold">Seleccionar todos los permisos visibles</label>
                                            </div>
                                        </div>
                                        
                                        <div class="permissions-container" style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; border-radius: 4px; padding: 10px;">
                                            @foreach ($permissions as $permission)
                                            <div class="form-group clearfix permission-item" data-name="{{ strtolower($permission->name) }}">
                                                <div class="custom-control custom-checkbox">
                                                    {!! Form::checkbox('permissions[]', $permission->id, $role->hasPermissionTo($permission->id) ? : false, ['class'=>'custom-control-input permission-checkbox', 'id' => 'permission_'.$permission->id]) !!}
                                                    <label class="custom-control-label" for="permission_{{$permission->id}}">
                                                        {{$permission->name}}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        
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
                                const permissionItems = document.querySelectorAll('.permission-item');
                                const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
                                const permissionsForm = document.getElementById('permissionsForm');
                                const searchInput = document.getElementById('searchPermission');
                                
                                // Función para filtrar permisos
                                function filterPermissions() {
                                    const searchTerm = searchInput.value.toLowerCase();
                                    let visibleItems = 0;
                                    
                                    permissionItems.forEach(item => {
                                        const permissionName = item.getAttribute('data-name');
                                        const isVisible = permissionName.includes(searchTerm);
                                        item.style.display = isVisible ? 'block' : 'none';
                                        if (isVisible) visibleItems++;
                                    });
                                    
                                    // Actualizar el estado del checkbox "Seleccionar todos"
                                    updateSelectAllState();
                                }
                                
                                // Función para actualizar el estado del checkbox "Seleccionar todos"
                                function updateSelectAllState() {
                                    const visibleCheckboxes = Array.from(permissionItems)
                                        .filter(item => item.style.display !== 'none')
                                        .map(item => item.querySelector('.permission-checkbox'));
                                    
                                    if (visibleCheckboxes.length === 0) {
                                        selectAllCheckbox.checked = false;
                                        selectAllCheckbox.indeterminate = false;
                                        return;
                                    }
                                    
                                    const allChecked = visibleCheckboxes.every(checkbox => checkbox.checked);
                                    const someChecked = visibleCheckboxes.some(checkbox => checkbox.checked);
                                    
                                    selectAllCheckbox.checked = allChecked;
                                    selectAllCheckbox.indeterminate = someChecked && !allChecked;
                                }
                                
                                // Evento para el campo de búsqueda
                                searchInput.addEventListener('input', filterPermissions);
                                
                                // Evento para el checkbox "Seleccionar todos"
                                selectAllCheckbox.addEventListener('change', function() {
                                    const visibleItems = document.querySelectorAll('.permission-item:not([style*="display: none"]) .permission-checkbox');
                                    const isChecked = this.checked;
                                    visibleItems.forEach(checkbox => {
                                        checkbox.checked = isChecked;
                                    });
                                    // No es necesario llamar a updateSelectAllState aquí ya que los eventos change se dispararán
                                });
                                
                                // Mejorar la detección de cambios en los checkboxes individuales
                                document.addEventListener('change', function(e) {
                                    if (e.target && e.target.matches('.permission-checkbox')) {
                                        updateSelectAllState();
                                    }
                                });
                                
                                // Eventos para los checkboxes individuales
                                permissionItems.forEach(item => {
                                    const checkbox = item.querySelector('.permission-checkbox');
                                    checkbox.addEventListener('change', updateSelectAllState);
                                });
                                
                                // Prevenir envío del formulario si no hay permisos seleccionados
                                permissionsForm.addEventListener('submit', function(e) {
                                    const anyChecked = Array.from(permissionCheckboxes).some(checkbox => checkbox.checked);
                                    if (!anyChecked) {
                                        e.preventDefault();
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Permiso requerido',
                                            text: 'Por favor, selecciona al menos un permiso.',
                                            confirmButtonColor: '#3085d6',
                                        });
                                    }
                                });
                                
                                // Inicializar el estado
                                filterPermissions();
                            });
                        </script>
                        <style>
                            .permissions-container::-webkit-scrollbar {
                                width: 8px;
                            }
                            .permissions-container::-webkit-scrollbar-track {
                                background: #f1f1f1;
                                border-radius: 4px;
                            }
                            .permissions-container::-webkit-scrollbar-thumb {
                                background: #888;
                                border-radius: 4px;
                            }
                            .permissions-container::-webkit-scrollbar-thumb:hover {
                                background: #555;
                            }
                            .permission-item {
                                padding: 5px 10px;
                                transition: background-color 0.2s;
                            }
                            .permission-item:hover {
                                background-color: #f8f9fa;
                            }
                        </style>
                    @stop

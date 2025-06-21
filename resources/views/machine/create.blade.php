@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-desktop"></i> Registrar Máquina</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la Máquina</h3>
                            </div>


                            <form id="frmMachine" name="frmMachine" method="post" action="{{route('machine.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_itinerary">Local</label>
                                        <input type="text" class="form-control" id="premise_ident" name="premise_ident" value="{{$premise->ident}}" readonly>
                                   </div>
                                   <div class="form-group">
                                    <label for="name_itinerary">Responsable</label>
                                    <input type="text" class="form-control" id="responsible" name="responsible" value="{{$premise->idc}}" readonly>
                               </div>
                                   
                                    <div class="form-group">
                                        <label for="last_names">Modelo</label>
                                        <input type="text" class="form-control" id="model" name="model"
                                            placeholder="Ingresa Modelo" minlength="2" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="names">Marca</label>
                                        <input type="text" class="form-control" id="brand" name="brand"
                                            placeholder="Ingresa Marca" minlength="2" maxlength="50">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Serial</label>
                                        <input type="text" class="form-control" id="seriale" name="seriale"
                                            placeholder="Ingresa Serial (Sólo números)" required pattern="[0-9]+" minlength="3" maxlength="15">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-laptop-medical"></i> Registrar</button>
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


    @switch(true)
        @case(session('delete') == 'OK')
            <script>
                Swal.fire({
                    title: "Local Eliminado!",
                    text: "El Local se ha eliminado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('store') == 'OK')
            <script>
                Swal.fire({
                    title: "Local Registrado!",
                    text: "El Local se ha Registrado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('edit') == 'OK')
            <script>
                Swal.fire({
                    title: "Local Modificado!",
                    text: "El Local se ha Modificado Exitosamente",
                    icon: "success"
                });
            </script>
        @break

        @case(session('storemachine') == 'OK')
        <script>
           
                Swal.fire({
                    title: "Máquina registrada",
                    text: "¿Desea Registrar más máquinas al mismo local?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "No",
                    cancelButtonText: "Si, seguir registrando",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{URL::to('api/machine')}}";
                    }
                });
        </script>
            
        @break
        @case(session('serialeduplicate') == 'OK')
                                <script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error en Serial",
                                        text: "Ya existe una Máquina con ese Serial!"
                                    });
                                </script>
                            @break



        @default
    @endswitch


    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Estás a punto de eliminar un Registro. Esta acción no se podrá revertir",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        })
    </script>
                    @stop

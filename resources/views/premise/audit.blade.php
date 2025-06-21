@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Auditar Local</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-8">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de Auditoria</h3>
                            </div>


                            <form id="frmAuditpremise" name="frmAuditpremise" method="post" action="{{route('premise.auditeject')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="names">Responsable</label>
                                        <input type="text" class="form-control" id="names"
                                            name="names" value="{{$responsible->names}} {{$responsible->last_names}}" readonly>
                                        <input type="hidden" class="form-control" id="idc_responsible" name="idc_responsible" value="{{$responsible->idc}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ident">Código Local</label>
                                        <input type="text" class="form-control" id="ident" name="ident" value="{{$premise->ident}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ident">Cantidad de Máquinas</label>
                                        <input type="text" class="form-control" id="ident" name="ident" value="{{$countmachines}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th width="15px"></th>
                                                    <th width="150px">Código</th>
                                                    <th width="150px">Modelo</th>
                                                    <th width="150px">Marca</th>
                                                    <th width="150px">Serial</th>
                                                    <th width="300px">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    
                                                        @foreach ($machines as $countmachine => $machine)
                                                        <tr>
                                                            <td> {{$countmachine+1}} </td>
                                                            <td>{{$machine->code}}</td>
                                                            <td>{{$machine->model}}</td>
                                                            <td>{{$machine->brand}}</td>
                                                            <td>{{$machine->seriale}}</td>
                                                            @switch(true)
                                                                @case($machine->forfeiture_status==1)
                                                                    <td>Con orden de Confiscación</td>
                                                                    @break
                                                                @case($machine->penalty_status==1)
                                                                    <td>Multada</td>
                                                                    @break
                                                                @case($machine->debit_status==1)
                                                                    <td>Deudora</td>
                                                                    @break
                                                                @case($machine->active_status==1)
                                                                    <td>Activa-Solvente</td>
                                                                    @break
                                                                @default
                                                                    
                                                            @endswitch
                                                        </tr>
                                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <label for="ident">Observación</label>
                                        <textarea id="note" name="note" class="form-control" rows="3" style="height: 84px;"></textarea>
                                    </div>
                                    

                                    {{-- *************************HIDDENS****************************** --}}
                                        <input type="hidden" class="form-control" id="latitude" name="latitude">
                                    
                                        <input type="hidden" class="form-control" id="longitude" name="longitude">

                                    <div id="mylocation">

                                    </div>
                                    {{-- ******************************************************* --}}


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-plus"></i> Registrar</button>
                                </div>
                            </form>
                        </div>
                    @stop

                    @section('css')
                        {{-- Add here extra stylesheets --}}
                        {{-- <link rel="stylesheet" href="/css/admin_custom.css">  --}}
                    @stop

                    @section('js')
                        <script>
                            navigator.geolocation.getCurrentPosition(succsess, error);
                        
                            function succsess(geolocationPosition)
                            {
                                let coords = geolocationPosition.coords;
                                document.getElementById("latitude").value = coords.latitude;
                                document.getElementById("longitude").value = coords.longitude;
                            }

                            function error(err)
                            {
                                document.getElementById("mylocation").innerHTML="Debes permitir acceso a la ubicacion de tu dispositivo";
                            }
                        </script>
                    @stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Auditar Máquina</h1>
@stop

@section('content')


    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Datos de Auditoria</h3>
                            </div>


                            <form id="frmAuditmachine" name="frmAuditmachine" method="post" action="{{route('machine.auditejectmachine')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="premise_ident">Código Local</label>
                                        <input type="text" class="form-control" id="premise_ident" name="premise_ident" value="{{$machine->premise_ident}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Código de la Máquina</label>
                                        <input type="text" class="form-control" id="code" name="code" value="{{$machine->code}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="model">Modelo</label>
                                        <input type="text" class="form-control" id="model" name="model" value="{{$machine->model}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Marca</label>
                                        <input type="text" class="form-control" id="brand" name="brand" value="{{$machine->brand}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="seriale">Serial</label>
                                        <input type="text" class="form-control" id="seriale" name="seriale" value="{{$machine->seriale}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ident">Observación</label>
                                        <textarea id="note" name="note" class="form-control" rows="3" style="height: 84px;"></textarea>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                            </form>
                        </div>
                    @stop

                    @section('css')
                        {{-- Add here extra stylesheets --}}
                        {{-- <link rel="stylesheet" href="/css/admin_custom.css">  --}}
                    @stop

                    @section('js')
                        
                    @stop

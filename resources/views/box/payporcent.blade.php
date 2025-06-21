@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-money-bill"></i> Editar Porcentaje de pago para Empresa</h1>
@stop

@section('content')

    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Datos de Porcentaje</h3>
                            </div>


                            <form id="frmPayPorcent" name="frmPayPorcent" method="POST"
                                action="{{ route('box.updatepayporcent', $payporcent) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="porcentCompany">Porcentaje de pago a empresa</label>
                                        <input type="text" class="form-control" id="porcent_company" name="porcent_company"
                                            value="{{ $payporcent->porcent_company }}" required pattern="[0-9]+">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-solid fa-check"></i> Actualizar</button>
                                    </div>
                            </form>
                        </div>
                    @stop

                    @section('css')
                       
                    @stop

                    @section('js')
                       
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        @if (session('porcent') == 'OK')
                            <script>
                                Swal.fire({
                                    title: "¡Porcentaje editado!",
                                    text: "Porcentaje de pago para la empresa se ha Modificado Exitosamente",
                                    icon: "success"
                                });
                            </script>
                        @endif

                       
                    @stop

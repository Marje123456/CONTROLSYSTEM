@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-qrcode"></i> CÓDIGO QR PARA LA MÁQUINA <u><b>{{$machine->code}}</b></u></h1>

@stop

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="row mb-4 text-center">
                    <div class="col-sm-3 themed-grid-col">
                        <div>
                            <h5>{{ $machine->code }} </h5>
                        </div>
                        <div>
                            {!! QrCode::size(200)->generate('https://jetsystem.pro/api/auditviewmachine/' . $machine->id) !!}
                        </div>
                    </div>
            </div>
        </div>
    </section>


    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
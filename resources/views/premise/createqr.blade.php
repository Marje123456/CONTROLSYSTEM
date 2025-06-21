@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-solid fa-qrcode"></i> CÓDIGO QR PARA EL LOCAL <u><b>{{$premise->ident}}</b></u></h1>

@stop

@section('content')
<div>

    {!!QrCode::size(200)->generate('https://jetsystem.pro/api/auditview/'.$premise->id) !!}

   {{--  {!!QrCode::size(200)->generate
    (
        'Codigo del Local: '.$premise->ident.
        'Representante: '.$premise->idc.
        'RUT: '.$premise->rut.
        'Dirección: '.$premise->address.
        'Coordenadas: '.$premise->coordinates
    ) !!} --}}
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
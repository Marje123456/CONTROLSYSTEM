@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>CÓDIGOS QR CON ORDEN DE IMPRESIÓN</h1>

@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-4 text-center">
                @foreach ($machines as $machine)
                    <div class="col-sm-3 themed-grid-col">
                        <div>
                            <h5>{{ $machine->code }} </h5>
                        </div>
                        <div>
                            {!! QrCode::size(200)->generate('https://jetsystem.pro/api/auditviewmachine/' . $machine->id) !!}
                        </div>
                        <div  style="padding-bottom: 50px; padding-top: 7px">
                            <a href="{{ route('machine.changestatus2', $machine) }}" class="btn btn-warning btn-sm">Marcar como Impreso</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Recorridos</h1>
@stop

@section('content')
<div class="card-header">
    <a href="{{route('itinerary.create')}}" class="btn btn-primary">Nuevo Recorrido</a>
</div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="titineraries">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fiscal Asignado</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Barrio</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itineraries as $itinerary)
                        <tr>
                            <td>{{$itinerary->id_itinerary}}</td>
                            <td>{{$itinerary->name}}</td>
                            <td>{{$itinerary->idc_prosecutor}}</td>
                            @foreach ($departments as $department)
                                @if ($itinerary->department == $department->id)
                                    <td>{{ $department->name }}</td>
                                @endif
                            @endforeach
                            @foreach ($cities as $city)
                                @if ($itinerary->city == $city->id)
                                    <td>{{ $city->name }}</td>
                                @endif
                            @endforeach
                            @foreach ($neighborhoods as $neighborhood)
                                @if ($itinerary->neighborhood == $neighborhood->id)
                                    <td>{{ $neighborhood->name }}</td>
                                @endif
                            @endforeach
                            <td><a href="{{route('itinerary.map',$itinerary)}}" class="btn btn-warning btn-sm"><i class="fas fa-solid fa-eye"></i><i class="fas fa-fw fa-route"></i></a></td>
                            {{-- <td><a href="{{route('prosecutor.viewitinerary',$prosecutor)}}" class="btn btn-warning btn-sm"><i class="fas fa-solid fa-eye"></i><i class="fas fa-fw fa-route"></i></a></td> --}}
                            <td width="15px"><a href="{{route('itinerary.edit',$itinerary)}}" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-pen"></i></a></td>
                            <td width="15px">
                                <form action="{{route('itinerary.destroy',$itinerary)}}" class="form-delete" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"  class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i></button>
                                    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#titineraries').DataTable();
    });
</script>

{{-- Secction SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@switch(true)
    @case(session('delete') == 'OK')
        <script>
            Swal.fire({
                title: "¡Recorrido Eliminado!",
                text: "El Recorrido se ha eliminado Exitosamente",
                icon: "success"
            });
        </script>
    @break
    @case(session('edititinerary') == 'OK')
            <script>
                Swal.fire({
                    title: "¡Recorrido Modificado!",
                    text: "El Recorrido se ha Modificado Exitosamente",
                    icon: "success"
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


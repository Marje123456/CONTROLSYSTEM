<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cierres de Caja</title>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h3>LISTADO DE MÁQUINAS</h3>
            <table class="table table-striped" id="tprosecutors">
                <thead>
                    <tr>
                        <th width="100px">Código</th>
                        <th width="100px">Local</th>
                        <th width="100px">Serial</th>
                        <th width="100px">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machines as $machine)
                        <tr>
                            <td style="text-align: center;">{{$machine->code}}</td>
                            <td style="text-align: center;">{{$machine->premise_ident}}</td>
                            <td style="text-align: center;">{{$machine->seriale}}</td>
                            @switch(true)
                                @case($machine->qr_status == 0)
                                    <td>Qr No pago</td>
                                @break

                                @case($machine->qr_status == 1)
                                    <td>QR en Impresión</td>
                                @break

                                @case($machine->qr_status == 2)
                                    <td>Por Activación</td>
                                @break

                                @case($machine->active_status == 0)
                                    <td>Inactiva</td>
                                @break

                                @case($machine->forfeiture_status == 1)
                                    <td>Confiscada</td>
                                @break

                                @case($machine->penalty_status == 1)
                                    <td>Multada</td>
                                @break

                                @case($machine->debit_status == 1)
                                    <td>Deudora</td>
                                @break

                                @case($machine->active_status == 1)
                                    <td>Activa</td>
                                @break

                                @default
                            @endswitch
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
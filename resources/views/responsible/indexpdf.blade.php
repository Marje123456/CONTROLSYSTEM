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
            <h3>LISTADO DE LOCALES</h3>
            <table class="table table-striped" id="tprosecutors">
                <thead>
                    <tr>
                        <th width="100px">Cédula</th>
                        <th width="100px">Nombre</th>
                        <th width="100px">Apellidos</th>
                        <th width="100px">Teléfono</th>
                        <th width="100px">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsibles as $responsible)
                        <tr>
                            <td style="text-align: center;">{{$responsible->names}}</td>
                            <td style="text-align: center;">{{$responsible->last_names}}</td>
                            <td style="text-align: center;">{{$responsible->idc}}</td>
                            <td style="text-align: center;">{{$responsible->phone}}</td>
                            <td style="text-align: center;">{{$responsible->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
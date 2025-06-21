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
            <h3>LISTADO DE RESPONSABLES</h3>
            <table class="table table-striped" id="tprosecutors">
                <thead>
                    <tr>
                        <th width="100px">Código</th>
                        <th width="100px">Nombre de Comercio</th>
                        <th width="100px">Representante</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premises as $premise)
                        <tr>
                            <td style="text-align: center;">{{$premise->ident}}</td>
                            <td style="text-align: center;">{{$premise->name}}</td>
                            <td style="text-align: center;">{{$premise->idc}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
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
            <h3>CIERRES DE CAJA</h3>
            <table class="table table-striped" id="tprosecutors">
                <thead>
                    <tr>
                        <th width="100px">Fecha Cierre</th>
                        <th width="100px">Caja</th>
                        <th width="100px">Monto Total</th>
                        <th width="100px">Efectivo</th>
                        <th width="100px">Transferencia</th>
                        <th width="100px">QR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($closeboxs as $closebox)
                        <tr>
                            <td style="text-align: center;">{{$closebox->close_date}}</td>
                            <td style="text-align: center;">{{$closebox->userbox}}</td>
                            <td style="text-align: center;">{{$closebox->total_amount}}</td>
                            <td style="text-align: center;">{{$closebox->total_cash}}</td>
                            <td style="text-align: center;">{{$closebox->total_trans}}</td>
                            <td style="text-align: center;">{{$closebox->total_qr}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
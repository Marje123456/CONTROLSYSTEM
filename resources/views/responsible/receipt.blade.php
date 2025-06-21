<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2><i class="fas fa-solid fa-desktop"></i> Recibo de cobro N°<b><u>0-00{{ $idreceiptconsult->id }}</u></b></h2>
    <form >
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="mounttotalpay"><b>Responsable: </b></label> 
                <label for="mounttotalpay">{{ $responsible->idc }}</label>
                <label for="paymenttype">{{ $responsible->names }} {{ $responsible->last_names }}</label>
            </div>
            <div class="form-group">
                <label for="mounttotalpay"><b>Total a Pagar: </b></label> 
                <label for="mounttotalpay">{{ $receipt->total_amount }}</label>
                <label for="paymenttype"><b>Tipo de  Pago: </b></label>
                <label for="paymenttype">{{ $paymenttype->nametype }}</label>
            </div>
        </div>
    </form>
    
    <div class="card">
        <div class="card-body">
            <h3>Máquinas canceladas</h3>
            <table class="table table-striped" id="tmachines">
                <thead>
                    <tr>
                        <th>Código de máquina </th>
                        <th>| Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machinespayments as $machine)
                        <tr>
                            <td>{{ $machine->code_machine }}</td>
                            <td>{{ $machine->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
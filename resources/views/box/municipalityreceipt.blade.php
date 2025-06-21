<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cierre</title>
</head>
<body>
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Cierre de caja para el día {{$date_close_box}} </h3>
                            </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="close_date"><b>Fecha de Cierre: </b></label>
                                        <label for="">{{$date_close_box}}</label>
                                   </div>
                                    <div class="form-group">
                                        <label for="total_cash"><b>Efectivo: </b></label>
                                        <label for="">{{$total_cash}}</label>
                                   </div>
                                    <div class="form-group">
                                        <label for="total_trans"><b>Transferencia: </b></label>
                                        <label for="">{{$total_trans}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_qr"><b>Qr: </b></label>
                                        <label for="">{{$total_QR}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_amount"><b>Total Recaudado: </b></label>
                                        <label for="">{{$total_amount}}</label>
                                   </div>
                                    <div class="form-group">
                                        <label for="mount_company"><b>Monto para empresa: </b></label>
                                        <label for="">{{$porcent_company}}</label>
                                    </div>
                                </div>
                                
                        </div>
</body>
</html>
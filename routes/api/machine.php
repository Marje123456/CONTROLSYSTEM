<?php
use App\Http\Controllers\QRMachineController;
use App\Http\Controllers\MachineController;

use Illuminate\Support\Facades\Route;
Route::group(['middleware' => 'auth'], function() {

    Route::resource('machine', MachineController::class)->names('machine'); 

    Route::get('machinecreatet/{premise}', [MachineController::class, 'createt'])->name('machine.createt');

    Route::get('activatemachine/{machine}', [QRMachineController::class, 'activatemachine'])->name('machine.activatemachine');

    Route::get('machinechangestatus/{machine}', [QRMachineController::class, 'changestatus1'])->name('machine.changestatus1');
    Route::get('machinechangestatus2/{machine}', [QRMachineController::class, 'changestatus2'])->name('machine.changestatus2');


    Route::get('machinera/{machine}', [MachineController::class, 'payment'])->name('machine.payment');
    Route::post('machinere/{machine}', [MachineController::class, 'paymenteject'])->name('machine.paymenteject');

    Route::get('machinerstatusmachine', [MachineController::class, 'statusmachine'])->name('machine.statusmachine');
    Route::put('machinestatus', [MachineController::class, 'updatestatusmachine'])->name('machine.updatestatusmachine');

    Route::get('machinetax', [MachineController::class, 'taxmachine'])->name('machine.taxmachine');
    Route::put('updatetaxmachine', [MachineController::class, 'updatetaxmachine'])->name('machine.updatetaxmachine');

    Route::get('machinepayment/{machine}', [MachineController::class, 'viewpayments'])->name('machine.viewpayments');

   

    Route::get('auditindexmachine', [MachineController::class, 'auditindexmachine'])->name('machine.auditindexmachine');
    Route::get('auditviewmachine/{machine}', [MachineController::class, 'auditview'])->name('machine.auditviewmachine');
    Route::post('auditejectmachine', [MachineController::class, 'auditeject'])->name('machine.auditejectmachine');

    Route::get('auditprubmachine/', [MachineController::class, 'auditprubmachine'])->name('machine.auditprubmachine');


    
    Route::get('machiner/{machine}', [QRMachineController::class, 'createqr'])->name('machine.createqr');
    Route::get('machineqrorders', [QRMachineController::class, 'qrorders'])->name('machine.qrorders');
    
    
    Route::get('indexpdfmach', [MachineController::class, 'indexpdfmach'])->name('machine.indexpdfmach');

    Route::get('reportgrafconsult', [MachineController::class, 'reportgrafconsult'])->name('machine.reportgrafconsult');

    Route::get('reportgraf', [MachineController::class, 'reportgraf'])->name('machine.reportgraf');


  });

    
    
 


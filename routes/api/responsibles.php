<?php

use App\Http\Controllers\ResponsibleController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [ResponsibleController::class, 'index']); */


Route::group(['middleware' => 'auth'], function() {
    Route::resource('responsible', ResponsibleController::class)->names('responsible');

    Route::get('paymachinesview/{responsible}', [ResponsibleController::class, 'paymachinesview'])->name('responsible.paymachinesview');
    Route::post('ejectpaymachines', [ResponsibleController::class, 'ejectpaymachines'])->name('responsible.ejectpaymachines');

    Route::get('receiptpayment', [ResponsibleController::class, 'receiptpayment'])->name('responsible.receiptpayment');
    
    Route::get('responsiblepayment', [ResponsibleController::class, 'responsiblepayment'])->name('responsible.responsiblepayment');

    Route::get('receiptpdf', [ResponsibleController::class, 'receiptpdf'])->name('responsible.receiptpdf');

    Route::get('reportall', [ResponsibleController::class, 'reportall'])->name('responsible.reportall');
    Route::get('reportallpdf', [ResponsibleController::class, 'reportallpdf'])->name('responsible.reportallpdf');

    Route::get('indexpdfresp', [ResponsibleController::class, 'indexpdfresp'])->name('responsible.indexpdfresp');
  });


<?php

use App\Http\Controllers\PremiseController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [ResponsibleController::class, 'index']); */
/* Route::resource('premise', PremiseController::class)->names('premise'); */

Route::group(['middleware' => 'auth'], function() {
  
  
    Route::resource('premise', PremiseController::class)->names('premise');

    Route::get('premisecreatet/{responsible}', [PremiseController::class, 'createt'])->name('premise.createt');

    Route::get('premiseqr/{premise}', [PremiseController::class, 'createqr'])->name('premise.createqr');

    Route::get('auditindex', [PremiseController::class, 'auditindex'])->name('premise.auditindex');
    Route::get('auditview/{premise}', [PremiseController::class, 'auditview'])->name('premise.auditview');
    Route::post('auditeject', [PremiseController::class, 'auditeject'])->name('premise.auditeject');
    Route::get('auditprub', [PremiseController::class, 'auditprub'])->name('premise.auditprub');

    Route::get('prubip', [PremiseController::class, 'prubip'])->name('premise.prubip');

    Route::get('premisemap', [PremiseController::class, 'map'])->name('premise.map');

    Route::get('indexpdfprem', [PremiseController::class, 'indexpdfprem'])->name('premise.indexpdfprem');
    
  });
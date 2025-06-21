<?php

use App\Http\Controllers\UseroController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [ResponsibleController::class, 'index']); */

Route::group(['middleware' => 'auth'], function() {
    Route::resource('usero', UseroController::class)->names('usero');

    Route::get('asignrole', [UseroController::class, 'asign'])->name('usero.asign');
  });
<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [ResponsibleController::class, 'index']); */


Route::group(['middleware' => 'auth'], function() {
    Route::resource('permissions', PermissionController::class)->names('permissions');
  });

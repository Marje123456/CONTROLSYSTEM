<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [ResponsibleController::class, 'index']); */


Route::group(['middleware' => 'auth'], function() {
    Route::resource('roles', RoleController::class)->names('roles');
  });

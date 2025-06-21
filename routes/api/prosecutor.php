<?php

use App\Http\Controllers\ProsecutorController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [ResponsibleController::class, 'index']); */

Route::group(['middleware' => 'auth'], function() {
    Route::resource('prosecutor', ProsecutorController::class)->names('prosecutor');
    
    Route::get('prosecutor/{prosecutor}', [ProsecutorController::class, 'viewitinerary'])->name('prosecutor.viewitinerary');
    Route::get('prosecutormyitinerary', [ProsecutorController::class, 'myitinerary'])->name('prosecutor.myitinerary');
  });


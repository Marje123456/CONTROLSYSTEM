<?php

use App\Http\Controllers\ItineraryController;
use Illuminate\Support\Facades\Route;

/* Route::get('/responsibles', [RouteController::class, 'index']); */
Route::group(['middleware' => 'auth'], function() {
    Route::resource('itinerary', ItineraryController::class)->names('itinerary');

    Route::get('itineraryasign', [ItineraryController::class, 'asignitinerary'])->name('itinerary.asignitinerary');
    Route::post('itineraryasignr', [ItineraryController::class, 'asignitineraryr'])->name('itinerary.asignitineraryr');
 
    Route::get('itinerarymap/{itinerary}', [ItineraryController::class, 'map'])->name('itinerary.map');
  });

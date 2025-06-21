<?php

use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function() 
{
    Route::resource('box', BoxController::class)->names('box');

    Route::get('closemunicipality', [BoxController::class, 'closemunicipality'])->name('box.closemunicipality');
    
    Route::post('closemunireceipt', [BoxController::class, 'closemunireceipt'])->name('box.closemunireceipt');

    Route::post('closemunipdf', [BoxController::class, 'closemunipdf'])->name('box.closemunipdf');

    Route::get('indexpdf', [BoxController::class, 'indexpdf'])->name('box.indexpdf');

    Route::get('payporcent', [BoxController::class, 'payporcent'])->name('box.payporcent');
    Route::put('updatepayporcent', [BoxController::class, 'updatepayporcent'])->name('box.updatepayporcent');

    
  });

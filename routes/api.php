<?php

require_once 'api/responsibles.php';
require_once 'api/premise.php';
require_once 'api/machine.php';
require_once 'api/prosecutor.php';
require_once 'api/itinerary.php';
require_once 'api/usero.php';
require_once 'api/role.php';
require_once 'api/permission.php';
require_once 'api/box.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

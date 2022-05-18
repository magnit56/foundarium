<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/rides/{car}/start/{user}', [\App\Http\Controllers\RideController::class, 'start']);
Route::patch('/rides/{car}/finish', [\App\Http\Controllers\RideController::class, 'finish']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

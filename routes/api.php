<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\LocationController;
use App\Models\Character;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('characters', CharacterController::class);
Route::patch('characters', [CharacterController::class, 'update']);
Route::delete('characters', [CharacterController::class, 'destroy']);

Route::resource('locations', LocationController::class);
Route::patch('locations', [LocationController::class, 'update']);
Route::delete('locations', [LocationController::class, 'destroy']);

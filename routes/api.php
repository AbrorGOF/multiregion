<?php

use App\Http\Controllers\DistrictController;
use Illuminate\Http\Request;
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
Route::get('/districts', [DistrictController::class, 'list']);
Route::post('/districts/create', [DistrictController::class, 'create']);
Route::delete('/districts/{district}', [DistrictController::class, 'delete']);


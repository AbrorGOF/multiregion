<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

foreach (\App\Models\District::cached() as $district) {
    Route::get('/'.$district->code, [HomeController::class, 'district']);
    Route::get('/'.$district->code.'/about', [HomeController::class, 'about']);
    Route::get('/'.$district->code.'/news', [HomeController::class, 'news']);
}

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

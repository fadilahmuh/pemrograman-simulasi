<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/input', [MainController::class, 'input'])->name('input');
Route::post('/manual-result', [MainController::class, 'manual'])->name('manual-result');

Route::get('/test', [MainController::class, 'index2']);
// Route::get('/test2', [MainController::class, 'index2']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

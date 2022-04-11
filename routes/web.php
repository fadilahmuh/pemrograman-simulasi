<?php

use App\Http\Controllers\DataController;
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
Route::post('/result', [MainController::class, 'result'])->name('result');
Route::get('/import', [MainController::class, 'import'])->name('import');
Route::post('/read-csv', [MainController::class, 'read_csv'])->name('read');

Route::resource('data', DataController::class);
Route::get('/history', [MainController::class, 'history'])->name('history');
Route::get('/history/view/{uniq}', [DataController::class, 'view_data'])->name('view-data');

Route::get('/test', [MainController::class, 'index2']);
// Route::get('/test2', [MainController::class, 'index2']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

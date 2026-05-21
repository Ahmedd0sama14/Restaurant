<?php

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

Route::get('/', [App\Http\Controllers\SolidersController::class, 'index'])
    ->name('import');
Route::post('import', 'App\Http\Controllers\solidersController@store')->name('import.store');
Route::get('soliders', 'App\Http\Controllers\solidersController@showAll')->name('soliders.showAll');
Route::get('soliders.showFill', 'App\Http\Controllers\solidersController@showFill')->name('soliders.exportFill');
Route::post('soliders.export', 'App\Http\Controllers\solidersController@export')->name('soliders.export');

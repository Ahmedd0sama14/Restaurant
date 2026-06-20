<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)->prefix('Admin')->name('admin.')->group(function(){
    Route::get('login','login')->name('login');
    Route::post('login','authenticate')->name('login.authenticate');
    Route::post('logout','logout')->name('logout')->middleware('admin');
    Route::get('dashboard', 'index')->name('dashboard')->middleware('admin');
});

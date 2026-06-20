<?php

use App\Http\Controllers\{BranchController, MenuController, RestaurantController};

use Illuminate\Support\Facades\Route;
Route::middleware('admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('restaurants', RestaurantController::class);
        Route::resource('restaurants.branch', BranchController::class);
        Route::resource('restaurants.menu', MenuController::class);

        Route::post(
            'restaurants/{restaurant}/menu/storeexcel',
            [MenuController::class, 'importmenu']
        )->name('menu.importmenu');
    });

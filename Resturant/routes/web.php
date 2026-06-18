<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderMemberItemController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
Route::controller(AdminController::class)->prefix('Admin')->name('admin.')->group(function(){
    Route::get('login','login')->name('login');
    Route::post('login','authenticate')->name('login.authenticate');
    Route::post('logout','logout')->name('logout')->middleware('admin');
    Route::get('dashboard', 'index')->name('dashboard')->middleware('admin');
});
Route::middleware('admin:3')->prefix('admin')->name('admin.')
 ->controller(AdminController::class,)->group(function () {
    Route::get('alladmin','showAllAdmin')->name('alladmin');
    Route::get('admin/create','create')->name('create');
    Route::post('admin/create','store')->name('store');
    Route::get('admin/{admin}/edit','edit')->name('edit');
    Route::put('admin/{admin}/update','update')->name('update');
    Route::delete('admin/{admin}/delete','delete')->name('delete');
});
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('restaurants.branch', BranchController::class);
    Route::resource('restaurants.menu', MenuController::class);
    Route::resource('members', AdminMemberController::class);
    Route::resource('orders', OrderController::class);
});
Route::prefix('orders/{order}/order-members/{orderMember}/items')
    ->controller(OrderMemberItemController::class)
    ->name('order-members.items.')
    ->group(function () {

        Route::get('/create', 'create')->name('create');

        Route::post('/', 'store')->name('store');

        Route::delete('/{orderMemberItem}', 'destroy')->name('destroy');
    });
    Route::put('/admin/orders/{order}/items/{item}',
     [OrderMemberItemController::class, 'update'])
     ->name('order-members.items.update');
Route::delete('/admin/orders/{order}/members/{orderMember}',[OrderMemberItemController::class, 'deleteMenber'])->name('order.members.destroy');
Route::get('order/members/{order}',[OrderController::class, 'createMember'])->middleware('admin')->name('order.members.create');
Route::post('order/members/{order}',[OrderController::class, 'storeMember'])->middleware('admin')->name('order.members.store');

<?php

use App\Http\Controllers\{OrderController,OrderMemberItemController,AdminMemberController};
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

     Route::resource('orders', OrderController::class);
     Route::get('orders/{order}/Details',[OrderController::class, 'Details'])->name('orders.Details');
     Route::resource('members', AdminMemberController::class);


        Route::get('orders/{order}/members/create',[OrderController::class, 'createMember'])->name('order.members.create');

        Route::post(
            'orders/{order}/members',
            [OrderController::class, 'storeMember']
        )->name('order.members.store');

        Route::delete(
            'orders/{order}/members/{orderMember}',
            [OrderMemberItemController::class, 'deleteMember']
        )->name('order.members.destroy');

        // Order Member Items
        Route::prefix('orders/{order}/order-members/{orderMember}/items')
            ->controller(OrderMemberItemController::class)
            ->name('order-members.items.')
            ->group(function () {

                Route::get('/create', 'create')->name('create');

                Route::post('/', 'store')->name('store');

                Route::put('/{item}', 'update')->name('update');

                Route::delete('/{orderMemberItem}', 'destroy')->name('destroy');
            });
    });
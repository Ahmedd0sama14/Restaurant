<?php

use App\Http\Controllers\MemberOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderMemberItemController;
use Illuminate\Support\Facades\Route;

Route::get( 'orders/{order}/members/create',
[OrderController::class, 'createMember'])->name('order.members.create');

Route::post( 'orders/{order}/members',
    [OrderController::class, 'storeMember'])->name('order.members.store');

Route::delete( 'orders/{order}/members/{orderMember}',
 [OrderMemberItemController::class, 'deleteMember'])->name('order.members.destroy');

Route::prefix('orders/{order}/order-members/{orderMember}/items')
    ->name('order-members.items.')->controller(OrderMemberItemController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::put('/{item}','update')->name('update');
        Route::delete('/{orderMemberItem}', 'destroy')->name('destroy');
    });
Route::get( 'orders/{order}/member/create',
[MemberOrderController::class, 'index'])->name('order.member.create');

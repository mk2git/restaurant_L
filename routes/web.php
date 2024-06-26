<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SalesBookController;
use App\Http\Controllers\TakeoutController;
use App\Http\Controllers\TakeoutOrderController;
use App\Http\Controllers\TakeoutCheckoutController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'updateRole'])->name('profile.updateRole');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ReserveController::class)->group(function(){
        Route::get('reserve','index')->name('reserve.index');
        Route::post('reserve/date', 'getDate')->name('reserve.getDate');
        Route::post('reserve', 'store')->name('reserve.store');
        Route::put('reserve/{reserve_id}', 'update')->name('reserve.update');
        Route::put('dashboard/{reserve_id}', 'changeStatus')->name('reserve.changeStatus');
        Route::delete('reserve/{reserve_id}', 'destroy')->name('reserve.destroy');
    });

    Route::controller(MenuController::class)->group(function(){
        Route::get('menu', 'index')->name('menu.index');
        Route::get('menu/add', 'create')->name('menu.add');
        Route::post('menu/add', 'store')->name('menu.store');
        Route::put('menu/{menu_id}', 'update')->name('menu.update');
        Route::delete('menu/{menu_id}', 'destroy')->name('menu.destroy');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('category', 'index')->name('category.index');
        Route::post('category', 'getCategory')->name('category.getCategory');
        Route::post('category/add', 'store')->name('category.store');
        Route::get('category/{id}', 'show');
        Route::put('category/{category_id}', 'update')->name('category.update');
        Route::delete('category/{category_id}', 'destroy')->name('category.destroy');
    });

    Route::controller(TableController::class)->group(function(){
        Route::get('table', 'index')->name('table.index');
        Route::get('table/edit', 'edit')->name('table.edit');
        Route::post('table/edit', 'store')->name('table.store');
        Route::put('table/{id}', 'update')->name('table.update');
        Route::delete('table/edit', 'destroy')->name('table.destroy');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('order', 'index')->name('order.index');
        Route::get('order/create/{table_id}', 'create')->name('orders.create');
        Route::post('order/create', 'store')->name('orders.store');
        Route::get('order/edit/{table_id}', 'edit')->name('orders.edit');
        Route::put('order/show/{table_id}', 'update')->name('orders.update');
        Route::put('order/edit', 'changeOrderStatus')->name('orders.changeOrderStatus');
        Route::delete('order/edit/{order_id}', 'destroy')->name('orders.destroy');
    });

    Route::controller(ServeController::class)->group(function(){
        Route::get('serve', 'index')->name('serve.index');
        Route::put('serve', 'update')->name('serve.update');
        Route::delete('serve', 'destroy')->name('serve.destroy');
    });

    Route::controller(CheckoutController::class)->group(function(){
        Route::get('checkout', 'index')->name('checkout.index');
        Route::get('checkout/select', 'select')->name('checkout.select');
        Route::get('checkout/show/{table_id}', 'show')->name('checkout.show');
        Route::post('serve', 'storeAndUpdate')->name('checkout.store');
        Route::put('checkout', 'updateCheckStatus')->name('checkout.updateCheckStatus');
    });

    Route::controller(SalesBookController::class)->group(function(){
        Route::get('salesbook', 'index')->name('salesbook.index');
        // Route::post('salesbook/select', 'select')->name('salesbook.select');
    });

    Route::controller(TakeoutController::class)->group(function(){
        Route::get('takeout', 'create')->name('takeout.create');
        Route::post('takeout', 'store')->name('takeout.store');
        Route::get('takeout/order/{takeout_id}', 'showMenu')->name('takeout.order');
    });

    Route::controller(TakeoutOrderController::class)->group(function(){
        Route::get('takeout/order/{takeout_id}', 'create')->name('takeout-order.create');
        Route::post('takeout/order', 'store')->name('takeout-order.store');
        Route::get('takeout/edit/{takeout_id}', 'edit')->name('takeout-order.edit');
        Route::put('takeout/edit/{takeout_id}', 'update')->name('takeout-order.update');
        Route::put('serve/{takeout_id}', 'updateStatusDone')->name('takeout-order.updateStatusDone');
        Route::delete('takeout/edit/{takeout_id}', 'destroy')->name('takeout-order.delete');
        Route::get('takeout/order', 'sendMessage')->name('takeout-order.sendMessage');
        Route::delete('serve/takeout', 'cancel')->name('takeout-order.cancel');
    });

    Route::controller(TakeoutCheckoutController::class)->group(function(){
        Route::get('checkout/takeout', 'index')->name('takeout-check.index');
        Route::post('serve/takeout', 'storeAndUpdate')->name('takeout-check.store');
        Route::get('checkout/takeout/{takeout_id}', 'show')->name('takeout-check.show');
        Route::put('checkout/takeout' ,'updateCheckStatus')->name('takeout-check.updateCheckStatus');
    });

});

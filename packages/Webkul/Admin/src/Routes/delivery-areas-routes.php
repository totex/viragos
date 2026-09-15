<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\DeliveryAreaController;

Route::controller(DeliveryAreaController::class)->prefix('delivery-areas')->group(function () {
    Route::get('', 'index')->name('admin.delivery_areas.index');

    Route::get('create', 'create')->name('admin.delivery_areas.create');

    Route::post('create', 'store')->name('admin.delivery_areas.store');

    Route::get('edit/{id}', 'edit')->name('admin.delivery_areas.edit');

    Route::put('edit/{id}', 'update')->name('admin.delivery_areas.update');

    Route::delete('edit/{id}', 'destroy')->name('admin.delivery_areas.delete');
});

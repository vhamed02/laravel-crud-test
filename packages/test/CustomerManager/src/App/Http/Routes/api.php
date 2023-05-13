<?php

use Illuminate\Support\Facades\Route;
use Test\CustomerManager\App\Http\Controllers\CustomerController;

Route::group(config('BaceManager.bace_api_route'), function () {

    Route::controller(CustomerController::class)
    ->prefix('customer')
    ->name('customer')
    ->group(function(){
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->middleware('auth:sanctum')->name('store');
        Route::put('', 'update')->middleware('auth:sanctum')->name('update');
        Route::delete('', 'destroy')->middleware('auth:sanctum')->name('destroy');
    });

    

});
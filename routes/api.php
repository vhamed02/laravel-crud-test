<?php

use App\Presenter\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post( '/customer/create', [ CustomerController::class, 'create' ] )->name('customer.create');
Route::post( '/customer/{id}/update', [ CustomerController::class, 'update' ] )->name('customer.update');
Route::post( '/customer/{id}/delete', [ CustomerController::class, 'delete' ] )->name('customer.delete');
Route::get( '/customer/{customerId}', [ CustomerController::class, 'view' ] )->name('customer.view');

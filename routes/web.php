<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Controller;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MaintenanceController;

Route::controller(Controller::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('auth');

});

Route::controller(CarController::class)->middleware('auth')->group(function () {

    Route::get('/cars', 'cars')->name('cars');
    Route::post('/cars', 'store')->name('cars.store');
    Route::get('/cars/create', 'create')->name('cars.create');
    Route::delete('/cars/delete/{id}', 'destroy')->name('cars.destroy');
    Route::post('/cars/edit/{id}', 'edit')->name('cars.edit');
    Route::put('/cars/update/{id}', 'update')->name('cars.update');
    Route::get('/cars/{id}', 'show')->name('cars.show');

});

Route::controller(MaintenanceController::class)->middleware('auth')->group(function () {

    Route::get('/maintenances', 'maintenances')->name('maintenances');
    Route::post('/maintenances', 'store')->name('maintenances.store');
    Route::get('/maintenances/create', 'create')->name('maintenances.create');
    Route::delete('/maintenances/delete/{id}', 'destroy')->name('maintenances.destroy');
    Route::post('/maintenances/edit/{id}', 'edit')->name('maintenances.edit');
    Route::put('/maintenances/update/{id}', 'update')->name('maintenances.update');
    Route::get('/maintenances/{id}', 'show')->name('maintenances.show');

});
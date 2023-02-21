<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\equipmentController;
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

Route::get('/', fn() => view('welcome'))->name("index");
Route::get('/offers/my', [OfferController::class, 'myOffers'])->name('offers.my');
Route::resource('offers', OfferController::class);

Route::controller(ReservationController::class)->group(function () {
    Route::get('/reservations', 'index')->name('reservations.index');
    Route::get('/reservations/create/{equipmentId}', 'create')->name('reservations.create');
    Route::post('/reservations', 'store')->name('reservations.store');
    Route::get('/reservations/{reservation}', 'show')->name('reservations.show');
    Route::get('/reservations/{reservation}/edit', 'edit')->name('reservations.edit');
    Route::put('/reservations/{reservation}', 'update')->name('reservations.update');
    Route::delete('/reservations/{reservation}', 'destroy')->name('reservations.destroy');
});

Route::controller(equipmentController::class)->group(function () {
    Route::get('/equipments', 'index')->name('equipments.index');
    Route::get('/equipments/create/{offerId}', 'create')->name('equipments.create');
    Route::post('/equipments', 'store')->name('equipments.store');
    Route::get('/equipments/{equipment}', 'show')->name('equipments.show');
    Route::get('/equipments/{equipment}/edit', 'edit')->name('equipments.edit');
    Route::put('/equipments/{equipment}', 'update')->name('equipments.update');
    Route::delete('/equipments/{equipment}', 'destroy')->name('equipments.destroy');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('login.authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store')->name('register.store');
    Route::get('/users', 'index')->name('auth.index');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
});

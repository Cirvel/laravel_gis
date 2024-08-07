<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/crud', function () {
    return view('crud');
})->name("crud")->middleware("auth");
Route::resource('restaurants', RestaurantController::class);
// Route::resource('restaurants', RestaurantController::class)->middleware("auth");
Route::get('restaurants.search',    [RestaurantController::class, 'search'])->name('restaurants.search'); // main page
Route::get('restaurants.popup',    [RestaurantController::class, 'popup'])->name('restaurants.popup'); // main page

// Session
Route::get('login',    [UserController::class, 'index'])->name('login'); // main page
Route::get('logout',   [UserController::class, 'destroy'])->name('logout'); // logout
Route::post('auth',    [UserController::class, 'store'])->name('auth'); // auth
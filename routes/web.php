<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listing_item_controller;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

//rejestracja
Route::get('/register', [UserController::class, 'create']);

//stwórz usera
Route::post('/users', [UserController::class, 'store']);

//formularz logowania
Route::get('/login', [UserController::class, 'login']);

//logowanie
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//wylogowanie
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/search', [listing_item_controller::class,'index']);

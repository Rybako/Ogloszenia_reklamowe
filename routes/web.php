<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ListingItemController;
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

Route::get('/map', [MapController::class, 'index']);
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

//Ogloszenia
Route::get('/ogloszenia', [ListingItemController::class,'index'])->name('listing_item.index');
Route::any('/ogloszenia/szukaj', [ListingItemController::class,'search'])->name('listing_item.search');
Route::get('/ogloszenia/dodaj', [ListingItemController::class,'create'])->name('listing_item.create');
Route::post('/ogloszenia/dodaj_formularz', [ListingItemController::class,'create_form'])->name('listing_item.create_form');
Route::get('/ogloszenia/widok/{id}', [ListingItemController::class,'view'])->where(['id' => '[0-9]{1,5}'])->name('listing_item.view');

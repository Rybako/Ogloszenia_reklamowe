<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ListingItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect(route('listing_item.index'));
});

Route::get('/map', [MapController::class, 'index']);

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

//testowa implementacja mailowania
Route::get('/send',[MailController::class,'index']);

//użykownicy by o120d6
Route::get('/użytkownik/{id}', [UserController::class,'view'])->name('user.view'); // nie wiem czy dobrze tu jest kontroler

//Panel użytkownika

Route::get('/userpanel', [UserPanelController::class,'view'])->name('userpanel.view')->middleware('auth'); // tu trzeba będzie zmienić kontroler potem, albo dodać nowy
Route::get('/userpanel/listing_items', [UserPanelController::class,'listing_items'])->name('userpanel.listing_items')->middleware('auth');

//Obrazki
Route::get('/image/delete/{id}', [ImageController::class,'delete'])->name('image.delete')->middleware('auth');
Route::get('/image/set_main/{id}', [ImageController::class,'set_main'])->name('image.set_main')->middleware('auth');

//Ogloszenia
Route::get('/ogloszenia', [ListingItemController::class,'index'])->name('listing_item.index');
Route::any('/ogloszenia/szukaj', [ListingItemController::class,'search'])->name('listing_item.search');
Route::get('/ogloszenia/dodaj', [ListingItemController::class,'create'])->name('listing_item.create')->middleware('auth');
Route::get('/ogloszenia/edytuj/{id}', [ListingItemController::class,'edit'])->name('listing_item.edit')->middleware('auth');
Route::any('/ogloszenia/edytuj_formularz/{id}', [ListingItemController::class,'edit_form'])->name('listing_item.edit_form')->middleware('auth');
Route::any('/ogloszenia/dodaj_formularz', [ListingItemController::class,'create_form'])->name('listing_item.create_form')->middleware('auth');
Route::get('/ogloszenia/widok/{id}', [ListingItemController::class,'view'])->where(['id' => '[0-9]{1,5}'])->name('listing_item.view');

Route::get('/ogloszenia/delete/{id}', [ListingItemController::class,'delete'])->name('listing_item.delete')->middleware('auth');
Route::get('/ogloszenia/add_time/{id}', [ListingItemController::class,'add_time'])->name('listing_item.add_time')->middleware('auth');
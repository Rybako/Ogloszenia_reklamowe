<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\MessageController;

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

// Dodanie routingu auth dla veryfikacji email
Auth::routes(['verify' => true]);

// Przekierowanie standardowych ścieżek do naszej strony głównej /ogloszenia
Route::get('/', function () {return redirect(route('listing_item.index'));})->name('home');
Route::get('/home', function () {return redirect(route('listing_item.index'));});

// Wyświeltanie użytkowników
Route::get('/użytkownik/{id}', [UserController::class,'view'])->name('user.view');

// Wyszukkiwanie, wyświetlanie ogłoszeń
Route::get('/ogloszenia', [ListingItemController::class,'index'])->name('listing_item.index');
Route::any('/ogloszenia/szukaj', [ListingItemController::class,'search'])->name('listing_item.search');
Route::get('/ogloszenia/widok/{id}', [ListingItemController::class,'view'])->where(['id' => '[0-9]{1,5}'])->name('listing_item.view');

// Sekcja zawierająca routing dozwolony dla ról 'admin' i 'user'
Route::middleware('checkRole:user,admin')->group(function () {
    // Dodawanie ogłoszenia
    Route::get('/ogloszenia/dodaj', [ListingItemController::class,'create'])->name('listing_item.create');
    Route::any('/ogloszenia/dodaj_formularz', [ListingItemController::class,'create_form'])->name('listing_item.create_form');

    // Edytowanie ogłoszenia
    Route::get('/ogloszenia/edytuj/{id}', [ListingItemController::class,'edit'])->name('listing_item.edit');
    Route::any('/ogloszenia/edytuj_formularz/{id}', [ListingItemController::class,'edit_form'])->name('listing_item.edit_form');

    // Usuwanie ogłoszenia
    Route::get('/ogloszenia/delete/{id}', [ListingItemController::class,'delete'])->name('listing_item.delete');

    // Usuwanie zdjęcia
    Route::get('/zdjecie/usun/{id}', [ImageController::class,'delete'])->name('image.delete');

    // Ustawianie głównego zdjęcia
    Route::get('/zdjecie/ustaw_glowne/{id}', [ImageController::class,'set_main'])->name('image.set_main');

    // Przedłużanie ważności ogłoszenia
    Route::get('/ogloszenia/przedluz_czas/{id}', [ListingItemController::class,'add_time'])->name('listing_item.add_time');

    // Wyświetlanie ogłoszeń danego użytkownika
    Route::get('/panel_uzytkownika', [UserPanelController::class,'listing_items'])->name('userpanel.view');
});
Route::middleware('checkRole:admin')->group(function () {
    // Panel administratora
    Route::get('/adminpanel/userlist', [UserController::class, 'list'])->name('adminpanel');

    // Kasowanie użytkownika
    Route::post('/użytkownik/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Edycja użytkownika
    Route::get('/użytkownik/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/użytkownik/update/{user}', [UserController::class, 'update'])->name('user.update');

    // Blokowanie użytkownika
    Route::get('/użytkownik/blokuj/{id}', [UserController::class, 'block'])->name('user.block');

    // Odblokowanie użytkownika
    Route::get('/użytkownik/odblokuj/{id}', [UserController::class, 'unblock'])->name('user.unblock');

    // Blokowanie ogłoszenia
    Route::get('/ogloszenia/blokuj/{id}', [ListingItemController::class,'block'])->name('listing_item.block');

    // Odblokowanie ogłoszenia
    Route::get('/ogloszenia/odblokuj/{id}', [ListingItemController::class,'unblock'])->name('listing_item.unblock');
});

// Wyświetlanie szczegółów błędów
Route::get('/response', function(){return view('response');})->name('response');

Route::get('/messages', [MessageController::class,'index'])->name('messages.index');

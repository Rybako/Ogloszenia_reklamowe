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


Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Użykownicy
Route::get('/użytkownik/{id}', [UserController::class,'view'])->name('user.view');

//Ogloszenia nie zalogowane
Route::get('/ogloszenia', [ListingItemController::class,'index'])->name('listing_item.index');
Route::any('/ogloszenia/szukaj', [ListingItemController::class,'search'])->name('listing_item.search');

Route::middleware('checkRole:user')->group(function () {
    //Ogloszenia zalogowane
    Route::get('/ogloszenia/dodaj', [ListingItemController::class,'create'])->name('listing_item.create');
    Route::get('/ogloszenia/edytuj/{id}', [ListingItemController::class,'edit'])->name('listing_item.edit');
    Route::get('/ogloszenia/widok/{id}', [ListingItemController::class,'view'])->where(['id' => '[0-9]{1,5}'])->name('listing_item.view');

    //Obrazki
    Route::get('/image/delete/{id}', [ImageController::class,'delete'])->name('image.delete');
    Route::get('/image/set_main/{id}', [ImageController::class,'set_main'])->name('image.set_main');

    //Ogloszenia manipulacja
    Route::any('/ogloszenia/edytuj_formularz/{id}', [ListingItemController::class,'edit_form'])->name('listing_item.edit_form');
    Route::any('/ogloszenia/dodaj_formularz', [ListingItemController::class,'create_form'])->name('listing_item.create_form');
    Route::get('/ogloszenia/delete/{id}', [ListingItemController::class,'delete'])->name('listing_item.delete');
    Route::get('/ogloszenia/add_time/{id}', [ListingItemController::class,'add_time'])->name('listing_item.add_time');

    //Panel użytkownika
    Route::get('/userpanel',  function () {
        return redirect(route('userpanel.listing_items'));
    })->name('userpanel.view'); 
    Route::get('/userpanel/listing_items', [UserPanelController::class,'listing_items'])->name('userpanel.listing_items');

});
Route::middleware('checkRole:admin')->group(function () {
    //Panel administratora
    Route::get('/adminpanel/userlist', [UserController::class, 'list'])->name('adminpanel');
    
    //Użytkownicy dla panelu administratora
    Route::post('/użytkownik/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/użytkownik/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    
    //Manipulacja użytkownicy dla panelu administratora
    Route::post('/użytkownik/update/{user}', [UserController::class, 'update'])->name('user.update');
    
    //Zablokuj użytkownika
    Route::get('/użytkownik/blokuj/{id}', [UserController::class, 'block'])->name('user.block');
});

//Response, convinent when you dont know how to respond
Route::get('/response', function(){return view('response');})->name('response');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ListingItemController;

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
//Route::get('/search', function () {
//    return view('search');
//});
Route::get('/ogloszenia', [ListingItemController::class,'index'])->name('listing_item.index');
Route::any('/ogloszenia/szukaj', [ListingItemController::class,'search'])->name('listing_item.search');
Route::get('/ogloszenia/dodaj', [ListingItemController::class,'create'])->name('listing_item.create');
Route::post('/ogloszenia/dodaj_formularz', [ListingItemController::class,'create_form'])->name('listing_item.create_form');
Route::get('/ogloszenia/widok/{id}', [ListingItemController::class,'view'])->where(['id' => '[0-9]{1,5}'])->name('listing_item.view');
/*
Route::any('/ecommerce/list', 'EcommerceController@index_list')->name('ecommerce.index_list');
Route::get('/ecommerce/create', 'EcommerceController@create')->name('ecommerce.create');
Route::post('/ecommerce/create', 'EcommerceController@store')->name('ecommerce.store');
Route::get('/ecommerce/{id}/edit', 'EcommerceController@edit')->name('ecommerce.edit');
Route::patch('/ecommerce/{id}/edit', 'EcommerceController@update')->name('ecommerce.update');
Route::delete('/ecommerce/{id}', 'EcommerceController@destroy')->name('ecommerce.destroy');*/
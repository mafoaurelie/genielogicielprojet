<?php

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

Route::view('/','index')->name('index');
//Route::view('/','IndexController@home');


Route::get('/cities','HomeController@home');
Route::get('/appartements','HomesController@home');

// pour prefixer une route apres definition du g
// Route::group(function(){
//     Route::get('/','adminController@home');
// })->middleware(["admin","auth"])->prefix('admin');

Route::get('/admin','adminController@home')->middleware(["admin","auth"])->name('admin');
Route::get('/adminclient','adminController@Controleuser')->middleware(["admin","auth"])->name('adminclient');

Route::get('supprimer','CityController@destroy')->name('city.destroy');

Route::delete('supprimeruser','adminController@destroyuser')->name('destroyuser');
Route::delete('supprimerA','AppartementController@destroy')->name('apart.destroy');


//Route::get('/valider','CityController@valide')->name('city.valider');/

Route::get('/details/{id}','CityController@details');

Route::get('/valider/{id}','CityController@valide');
Route::get('/validerApartment/{id}','CityController@valideApartment');
Route::get('/supprimer/{id}','CityController@destroy');
Route::get('/supprimerApartement/{id}','CityController@destroy');

//Route::get('/validerA/{id}','AppartementController@valide');

Route::get('/detailsapa/{id}','AppartementController@detailsapa');

Route::get('/submission','CityController@submission')->name('submission');
Route::get('/submissionapa','AppartementController@submission')->name('submissionapa');

Route::post('/city/remove','CityController@remove');

Route::post('/city/update','CityController@store');

Route::post('/city/create','CityController@store');
Route::post('/apartment/create','AppartementController@store');

Route::post('/cities/filter','CityController@filter');

Route::get('/bills','PaymentController@getBills');

Route::post('/payment','PaymentController@pay');
Route::post('/payments','PaymentsController@pay');

Route::post('/payment/store','PaymentController@store');
Route::post('/payments/store','PaymentsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

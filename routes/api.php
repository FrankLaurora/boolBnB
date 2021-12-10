<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/apartments', 'Api\ApartmentController@index')->name('api.index');
Route::get('/apartments/{slug}', 'Api\ApartmentController@show')->name('api.apartment_show');
// Route::get('/apartments/search/{$query}', 'Api\ApartmentController@search')->name('api.apartment_search');
Route::get('/services', 'Api\ServiceController@index')->name('api.services');
Route::get('/services/{id}', 'Api\ServiceController@getService')->name('api.get_service');
Route::get('/pics/{id}', 'Api\PictureController@getApartmentImages')->name('api.get_images');

<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

// Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('productos', 'ProductsController');
    Route::resource('categorias', 'CategoriesController');
    Route::resource('secciones', 'SectionsController');
// });




Route::get('produts', 'ProductsController@index');
Route::get('categories', 'CategoriesController@index');
Route::get('sections', 'SectionsController@index');
Route::post('add-files-sections','SectionsController@saveAll');
Route::post('add-files-Categories','CategoriesController@saveAll');
Route::post('add-files-produts','ProductsController@saveAll');




Route::post('products/edit/{id}', 'ProductsController@update');
Route::get('productos/categoria/{id}', 'ProductsController@getGroup');
Route::get('categorias/seccion/{id}', 'CategoriesController@getGroup');
Route::post('sections/{id}', 'SectionsController@update');
Route::post('categories/{id}', 'CategoriesController@update');
Route::post('sections', 'SectionsController@store');
Route::post('categories', 'CategoriesController@store');
Route::post('products', 'ProductsController@store');


<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

// password crud
    Route::get('/forget-password', 'ForgotPasswordController@getEmail');
    Route::post('/forget-password', 'ForgotPasswordController@postEmail');

    Route::get('/reset-password/{token}', 'ResetPasswordController@getPassword');
    Route::post('/reset-password', 'ResetPasswordController@updatePassword');


    Route::group(['middleware' => ['auth']], function () {
    // Products CRUD
        Route::get('/products', 'Admin\ProductController@index')->name('products.index');
        Route::get('/products/create', 'Admin\ProductController@create')->name('products.create');
        Route::post('/products', 'Admin\ProductController@store')->name('products.store');
        Route::get('/products/{id}/edit', 'Admin\ProductController@edit')->name('products.edit');
        Route::post('/products/{id}', 'Admin\ProductController@update')->name('products.update');
        Route::get('/products/{id}/delete','Admin\ProductController@destroy')->name('products.delete');
        Route::delete('myproductsDeleteAll', 'Admin\ProductController@deleteAll');

    });

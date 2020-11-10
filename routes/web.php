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

// Route::get('/', function () {
//     return view('users/welcome');
// });


// Route::get('/login', function () {
//     return view('');
// });



Route::namespace('Users')->prefix('User')->group(function()
{
    Route::get('regster','AuthController@regsterForm')->name('regsterForm');
    Route::post('regster','AuthController@regster')->name('regster');
    Route::get('loginForm','AuthController@loginForm')->name('loginForm');
    Route::post('login','AuthController@login')->name('login');
});


Route::namespace('Users')->prefix('User')->middleware('auth')->group(function()
{
    Route::get('home','HomeController@index')->name('Dashboard');
    Route::get('pro/{id}','HomeController@showProducts')->name('showProducts');

    Route::prefix('Categories')->group(function()
    {
        Route::get('/','CategoriesController@index')->name('categories');
        Route::get('/create','CategoriesController@create')->name('categories.create');
        Route::post('/store','CategoriesController@store')->name('categories.store');
        Route::get('/edit/{id}','CategoriesController@edit')->name('categories.edit');
        Route::put('/update/{id}','CategoriesController@update')->name('categories.update');
        Route::get('/delete/{id}','CategoriesController@delete')->name('categories.delete');
        Route::get('/status/{id}','CategoriesController@status')->name('categories.status');
    });

    Route::prefix('Products')->group(function()
    {
        Route::get('/','ProductController@index')->name('products');
        Route::get('/create','ProductController@create')->name('products.create');
        Route::post('/store','ProductController@store')->name('products.store');
        Route::get('/edit/{id}','ProductController@edit')->name('products.edit');
        Route::put('/update/{id}','ProductController@update')->name('products.update');
        Route::get('/delete/{id}','ProductController@delete')->name('products.delete');
        Route::get('/status/{id}','ProductController@status')->name('products.status');
    });


    Route::prefix('ProductPhoto')->group(function()
    {
        Route::get('/','productPhotosController@index')->name('productPhotos');
        Route::get('/create','productPhotosController@create')->name('productPhotos.create');
        Route::post('/store','productPhotosController@store')->name('productPhotos.store');
        Route::get('/edit/{id}','productPhotosController@edit')->name('productPhotos.edit');
        Route::put('/update/{id}','productPhotosController@update')->name('productPhotos.update');
        Route::get('/delete/{id}','productPhotosController@delete')->name('productPhotos.delete');
        Route::get('/status/{id}','productPhotosController@status')->name('productPhotos.status');
    });
});



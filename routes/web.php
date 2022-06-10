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


Auth::routes();

Route::middleware('auth')
->prefix('admin')
->name('admin.')
->namespace('Admin')
->group( function(){

    // la URI sarà comunque "/admin" -> ciò viene specificato nel metodo "prefix"
    // il name sarà "admin.home" -> ciò viene specificato nel metodo "name" valido per l'intero group (punto-3)
    Route::get('/', 'HomeController@index')->name('home');

    // la URI per queste rotte sarà "localhost/admin/posts" -> ciò viene specificato nel metodo "prefix" 
    Route::resource('posts', 'PostController');

    // la URI per queste rotte sarà "localhost/admin/categories" -> ciò viene specificato nel metodo "prefix" 
    Route::resource('categories', 'CategoryController');
});

Route::get('{any?}', function(){
    
    return view('guest.home');

})->where("any", ".*");
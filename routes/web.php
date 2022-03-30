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
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::patch('/posts/{post}/toggle', 'PostController@toggle')->name('posts.toggle');
        Route::resource('posts', 'PostController');
        Route::get('/{any}', function () {
            abort(404);
        })->where('any', '.*');
    });

// mappa le rotte non intercettate nelle istruzioni precedenti
Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*");

<?php

use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('default');
});*/

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout'); // pour le login logout dans le menu principal
//Route::get('login', '/App\Http\Controllers\Auth\LoginController@login')->name('login'); // same as above except it's for the login

Route::get('/', 'ArticleController@index')->name('pages.index');
Route::get('about', 'Pagecontroller@about')->name('pages.about');
//Route::get('{slug}', 'ArticleController@show')->name('page.show');

Route::resource('articles', 'ArticleController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
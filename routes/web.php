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
// Route::get('about', 'Pagecontroller@about')->name('pages.about')->middleware('CheckRole');
Route::get('about', 'Pagecontroller@about')->name('pages.about');
Route::post('newsletter', 'NewsletterController@store')->name('newsletter.store');
//Route::get('{slug}', 'ArticleController@show')->name('page.show');

Route::resource('articles', 'ArticleController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Oauth

// Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('login.github');
// Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/{social}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback');
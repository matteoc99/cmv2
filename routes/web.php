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
    return view('landing');
})->name("landing");
Route::get("login", function () {
    return view('login');
})->name("login");
Route::post("login","App\\Http\\Controllers\\AuthController@login");

Route::get("register", function () {
    return view('register');
})->name("register");
Route::post("register","App\\Http\\Controllers\\AuthController@register");
Route::get("logout","App\\Http\\Controllers\\AuthController@logout")->name("logout");


Route::get('/privacy', 'FrontendController@privacy')->name('privacy');
Route::get('/terms', 'FrontendController@terms')->name('terms');
Route::group(['middleware'=>['auth']],function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name("dashboard");
    Route::get('/createCondominium', function () {
        return view('createCondominium');
    })->name("createCondominium");
    Route::post('/createCondominium', 'App\Http\Controllers\CondominiumController@create')->name('createCondominium');

});

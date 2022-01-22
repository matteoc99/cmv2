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

Route::get('/', "App\\Http\\Controllers\\FrontendController@showLanding")->name("landing");

Route::get("login", function () {
    return view('login');
})->name("login");
Route::post("login", "App\\Http\\Controllers\\AuthController@login");
Route::get("passwordForgotten", function () {
    return view('passwordForgotten');
})->name("passwordForgotten");
Route::post("resetPassword", "App\\Http\\Controllers\\PasswordResetController@resetPassword")->name("resetPasswordPost");
Route::get("resetPassword/{token}", "App\\Http\\Controllers\\PasswordResetController@showReset")->name("resetPassword");
Route::post("reset", "App\\Http\\Controllers\\PasswordResetController@reset")->name("reset");

Route::get("register", function () {
    return view('register');
})->name("register");
Route::post("register", "App\\Http\\Controllers\\AuthController@register");
Route::get("logout", "App\\Http\\Controllers\\AuthController@logout")->name("logout");
Route::get('/privacy', 'FrontendController@privacy')->name('privacy');
Route::get('/terms', 'FrontendController@terms')->name('terms');
Route::get('/language/{locale}', 'App\\Http\\Controllers\\FrontendController@language')->name('language');
Route::group(['middleware' => ['auth']], function () {
    Route::get("/changePassword", function () {
        return view('changePassword');
    })->name("changePassword");
    Route::post("changePassword", "App\\Http\\Controllers\\AuthController@changePassword");

    Route::group(['middleware' => ['freshPass']], function () {

        Route::get('/dashboard', 'App\\Http\\Controllers\\DashboardController@show')->name("dashboard");
        Route::get('/settings', 'App\\Http\\Controllers\\SettingController@show')->name("settings");
        Route::post('/updateSettings', 'App\\Http\\Controllers\\SettingController@update')->name("updateSettings");
        Route::get('/createCondominium', 'App\\Http\\Controllers\\CondominiumController@showCreate')->name("createCondominium");
        Route::post('/createCondominium', 'App\\Http\\Controllers\\CondominiumController@create')->name('createCondominiumPost');
        Route::get('/condominium/{condominium}', 'App\\Http\\Controllers\\CondominiumController@show')->name("condominium");
        Route::get('/condominium/{condominium}/createFamily', "App\\Http\\Controllers\\FamilyController@showCreate")->name("createFamily");
        Route::post('/createFamily', 'App\\Http\\Controllers\\FamilyController@create')->name('createFamilyPost');
        Route::get('/condominium/{condominium}/createTicket', "App\\Http\\Controllers\\TicketController@showCreate")->name("createTicket");
        Route::post('/createTicket', 'App\\Http\\Controllers\\TicketController@create')->name('createTicketPost');
        Route::get('/ticket/{ticket}', 'App\\Http\\Controllers\\TicketController@show')->name('ticket');



        Route::post('/support', function () {
            return view('support');
        }
        )->name('support');

    });
});

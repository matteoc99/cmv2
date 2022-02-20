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
    return view('auth/login');
})->name("login");
Route::post("login", "App\\Http\\Controllers\\AuthController@login");
Route::get("passwordForgotten", function () {
    return view('auth/passwordForgotten');
})->name("passwordForgotten");
Route::post("resetPassword", "App\\Http\\Controllers\\PasswordResetController@resetPassword")->name("resetPasswordPost");
Route::get("resetPassword/{token}", "App\\Http\\Controllers\\PasswordResetController@showReset")->name("resetPassword");
Route::post("reset", "App\\Http\\Controllers\\PasswordResetController@reset")->name("reset");

Route::get("register", function () {
    return view('auth/register');
})->name("register");
Route::post("register", "App\\Http\\Controllers\\AuthController@register");
Route::get("logout", "App\\Http\\Controllers\\AuthController@logout")->name("logout");
Route::get('/privacy', 'FrontendController@privacy')->name('privacy');
Route::get('/terms', 'FrontendController@terms')->name('terms');
Route::get('/language/{locale}', 'App\\Http\\Controllers\\FrontendController@language')->name('language');


Route::get('/ticket/token/{token}', 'App\\Http\\Controllers\\TicketController@showBytoken')->name('ticketByToken');

Route::group(['middleware' => ['auth']], function () {
    Route::get("/changePassword", function () {
        return view('auth/changePassword');
    })->name("changePassword");
    Route::post("changePassword", "App\\Http\\Controllers\\AuthController@changePassword");

    Route::group(['middleware' => ['freshPass']], function () {

        Route::get('/dashboard', 'App\\Http\\Controllers\\DashboardController@show')->name("dashboard");

        Route::get('/profile/{user}', 'App\\Http\\Controllers\\UserController@show')->name("profile");
        Route::get('/settings', 'App\\Http\\Controllers\\SettingController@show')->name("settings");
        Route::post('/updateSettings', 'App\\Http\\Controllers\\SettingController@update')->name("updateSettings");
        Route::post('/updateNotificationSettings', 'App\\Http\\Controllers\\SettingController@updateNotification')->name("updateNotificationSettings");
        Route::get('/settings/setBoxView', 'App\\Http\\Controllers\\SettingController@setBoxView')->name("setBoxView");
        Route::get('/settings/setListView', 'App\\Http\\Controllers\\SettingController@setListView')->name("setListView");


        Route::get('/createCondominium', 'App\\Http\\Controllers\\CondominiumController@showCreate')->name("createCondominium");
        Route::post('/createCondominium', 'App\\Http\\Controllers\\CondominiumController@create')->name('createCondominiumPost');
        Route::get('/condominium/{condominium}', 'App\\Http\\Controllers\\CondominiumController@show')->name("condominium");
        Route::get('/condominiumEdit/{condominium}', 'App\\Http\\Controllers\\CondominiumController@showEdit')->name("editCondominium");
        Route::post('/condominiumEdit/{condominium}', 'App\\Http\\Controllers\\CondominiumController@update')->name("editCondominiumPost");

        Route::get('/condominium/{condominium}/createFamily', "App\\Http\\Controllers\\FamilyController@showCreate")->name("createFamily");
        Route::post('/createFamily', 'App\\Http\\Controllers\\FamilyController@create')->name('createFamilyPost');
        Route::get('/condominium/{condominium}/editFamily/{family}', "App\\Http\\Controllers\\FamilyController@showEdit")->name("editFamily");
        Route::post('/editFamily/{family}', 'App\\Http\\Controllers\\FamilyController@update')->name('editFamilyPost');
        Route::post('/deleteFamily/{family}', 'App\\Http\\Controllers\\FamilyController@delete')->name('deleteFamily');

        Route::get('/condominium/{condominium}/createTicket', "App\\Http\\Controllers\\TicketController@showCreate")->name("createTicket");
        Route::post('/createTicket', 'App\\Http\\Controllers\\TicketController@create')->name('createTicketPost');
        Route::post('/updateTicket/{ticket}', 'App\\Http\\Controllers\\TicketController@update')->name('updateTicketPost');
        Route::post('/addToCraftsman', 'App\\Http\\Controllers\\TicketController@addToCraftsman')->name('addToCraftsman');
        Route::get('/ticket/{ticket}', 'App\\Http\\Controllers\\TicketController@show')->name('ticket');
        Route::get('/ticket/generateToken/{ticket}', 'App\\Http\\Controllers\\TicketController@generateTicketToken')->name('generateTicketToken');
        Route::get('/ticket/addCraftsman/{ticket}/{user}', 'App\\Http\\Controllers\\TicketController@addCraftsmanToTicket')->name('addCraftsmanToTicket');
        Route::get('/ticket/complete/{ticket}', 'App\\Http\\Controllers\\TicketController@complete')->name('ticket.complete');
        Route::get('/ticket/ticketMarkAsInProgress/{ticket}', 'App\\Http\\Controllers\\TicketController@markAsInProgress')->name('ticketMarkAsInProgress');



        Route::post('/messages/{chat}', 'App\\Http\\Controllers\\MessageController@store')->name("sendMessage");

        Route::post('/createEstimate', 'App\\Http\\Controllers\\EstimateController@create')->name("createEstimate");
        Route::get('/approveEstimate/{estimate}', 'App\\Http\\Controllers\\EstimateController@approve')->name("approveEstimate");


        Route::post('/support', function () {
            return view('support');
        }
        )->name('support');


        Route::get('/subscribe/cancel/', [App\Http\Controllers\SubscriptionController::class, 'cancel'])->name('subscribe.cancel');
        Route::get('/subscribe/declined/{plan}/', [App\Http\Controllers\SubscriptionController::class, 'declined'])->name('subscribe.declined');
        Route::get('/subscribe/approved/{plan}/', [App\Http\Controllers\SubscriptionController::class, 'approved'])->name('subscribe.approved');
        Route::post('/subscribe/{plan}/', [App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
        Route::get('/subscribe/{plan}/', [App\Http\Controllers\SubscriptionController::class, 'show'])->name('subscribe.show');
        Route::get('/subscribe/redirect/', [App\Http\Controllers\SubscriptionController::class, 'redirectToSubscribe'])->name('subscribe.redirect');



        Route::get('/export/excel/{condominium}', [App\Http\Controllers\ExportController::class, 'exportToExcel'])->name('exportToExcel');



     // Route::get('/test', 'App\\Http\\Controllers\\FrontendController@test')->name("test");


    });
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes(['register' => false]);

Route::get('/',function(){
    return redirect()->route('dashboard.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//dashboard routs
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get('/index', [App\Http\Controllers\dashboard\dashboardController::class, 'index'])->name('index');

        route::resource('users' ,'UserController')->except(['show']);

        });

    });
//dashboard routs

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use Mcamara\LaravelLocalization\LaravelLocalization;

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
    return redirect()->route('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//dashboard routs
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get('/', [App\Http\Controllers\dashboard\welcomeController::class, 'index'])->name('welcome');

        Route::get('/index', [App\Http\Controllers\dashboard\welcomeController::class, 'index'])->name('index');

        //User Route
        route::resource('users' ,'dashboard\UserController')->except(['show']);

        //Category  Route
        route::resource('categories','dashboard\CategoryController')->except(['show']);

        //product  Route
        route::resource('products','dashboard\productController')->except(['show']);

        //client  Route
        route::resource('clients','dashboard\clientController')->except(['show']);
        route::resource('clients.orders','dashboard\client\orderController')->except(['show']);

        });

    }); //end dashboard routs

<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/index', [App\Http\Controllers\dashboard\dashboardController::class, 'index'])->name('index');

            route::resource('users' ,'UserController')->except(['show']);
        });

    });






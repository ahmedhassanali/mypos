<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ],
function(){

        Route:: prefix('dashboard')->name('dashboard.')->group(function(){

            Route::get('/index', [App\Http\Controllers\dashboard\dashboardController::class, 'index'])->name('index');
        });

    });






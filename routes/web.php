<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'controller' => AuthController::class,
        'middleware' => 'noAuthToken',
    ],
    static function () {
        Route::get('/', 'view')->name('auth.view');
        Route::post('/auth', 'processCodeAuth')->name('auth.code');
    }
);

Route::group(
    [
        'controller' => DataController::class,
        'middleware' => 'authToken'
    ],
    static function () {
        Route::get('/deal', 'getDealFromDB')->name('deal.list');
        Route::post('/deal/update', 'updateDealFromAmoCRM')->name('deal.Update');
    }
);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('authToken')
    ->name('logout');

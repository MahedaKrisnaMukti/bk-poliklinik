<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::group(
    [],
    function () {
        Route::get('/login', [LoginController::class, 'index'])
            ->middleware(['guest'])
            ->name('login');

        Route::post('/authenticate', [LoginController::class, 'authenticate'])
            ->middleware(['guest'])
            ->name('authenticate');

        Route::post('/logout', [LoginController::class, 'logout'])
            ->middleware(['auth'])
            ->name('logout');
    }
);


/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/

Route::group(
    [],
    function () {
        Route::get('/registrasi', [RegisterController::class, 'index'])
            ->middleware(['guest'])
            ->name('register');

        Route::post('/registration', [RegisterController::class, 'registration'])
            ->middleware(['guest'])
            ->name('registration');
    }
);

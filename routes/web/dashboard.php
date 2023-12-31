<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\MainMenu\MainMenuController;

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
| Main Menu
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'main-menu.',
        'middleware' => ['auth'],
        'prefix' => 'menu-utama',
    ],
    function () {
        Route::get('', [MainMenuController::class, 'index'])
            ->name('index');

        Route::get('profil', [MainMenuController::class, 'profile'])
            ->name('profile');

        Route::put('ubah-profil', [MainMenuController::class, 'updateProfile'])
            ->name('updateProfile');
    }
);

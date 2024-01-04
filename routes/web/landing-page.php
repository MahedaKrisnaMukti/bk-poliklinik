<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPage\LandingPageController;

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
| Landing Page
|--------------------------------------------------------------------------
*/

Route::group(
    [],
    function () {
        Route::get('/', [LandingPageController::class, 'index'])
            ->middleware(['guest'])
            ->name('login');
    }
);

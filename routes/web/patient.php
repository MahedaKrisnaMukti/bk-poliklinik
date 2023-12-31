<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Patient\PoliRegisterController;

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
| Mendaftar Poli
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'doctor.poli-register.',
        'middleware' => ['auth', 'role:Pasien'],
        'prefix' => 'pasien',
    ],
    function () {
        Route::get('mendaftar-poli', [PoliRegisterController::class, 'index'])
            ->name('index');

        Route::get('mendaftar-poli/datatable', [PoliRegisterController::class, 'datatable'])
            ->name('datatable');

        Route::get('mendaftar-poli/cek-jadwal-periksa', [PoliRegisterController::class, 'checkCheckupSchedule'])
            ->name('checkCheckupSchedule');

        Route::get('mendaftar-poli/create', [PoliRegisterController::class, 'create'])
            ->name('create');

        Route::get('mendaftar-poli/{id}', [PoliRegisterController::class, 'show'])
            ->name('show');

        Route::post('mendaftar-poli', [PoliRegisterController::class, 'store'])
            ->name('store');
    }
);

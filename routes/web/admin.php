<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\DoctorController;
use App\Http\Controllers\Dashboard\Admin\PatientController;
use App\Http\Controllers\Dashboard\Admin\PoliController;
use App\Http\Controllers\Dashboard\Admin\MedicineController;

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
| Dokter
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'admin.doctor.',
        'middleware' => ['auth', 'role:Admin'],
        'prefix' => 'admin',
    ],
    function () {
        Route::get('dokter/datatable', [DoctorController::class, 'datatable'])
            ->name('datatable');

        Route::resource('dokter', DoctorController::class);
    }
);

/*
|--------------------------------------------------------------------------
| Pasien
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'admin.patient.',
        'middleware' => ['auth', 'role:Admin'],
        'prefix' => 'admin',
    ],
    function () {
        Route::get('pasien/datatable', [PatientController::class, 'datatable'])
            ->name('datatable');

        Route::resource('pasien', PatientController::class);
    }
);

/*
|--------------------------------------------------------------------------
| Poli
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'admin.poli.',
        'middleware' => ['auth', 'role:Admin'],
        'prefix' => 'admin',
    ],
    function () {
        Route::get('poli/datatable', [PoliController::class, 'datatable'])
            ->name('datatable');

        Route::resource('poli', PoliController::class);
    }
);

/*
|--------------------------------------------------------------------------
| Obat
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'admin.medicine.',
        'middleware' => ['auth', 'role:Admin'],
        'prefix' => 'admin',
    ],
    function () {
        Route::get('obat/datatable', [MedicineController::class, 'datatable'])
            ->name('datatable');

        Route::resource('obat', MedicineController::class);
    }
);

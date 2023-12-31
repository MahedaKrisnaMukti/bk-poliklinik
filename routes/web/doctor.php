<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Doctor\CheckupScheduleController;
use App\Http\Controllers\Dashboard\Doctor\PatientListController;
use App\Http\Controllers\Dashboard\Doctor\PatientHistoryController;

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
| Jadwal Periksa
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'doctor.checkup-schedule.',
        'middleware' => ['auth', 'role:Dokter'],
        'prefix' => 'dokter',
    ],
    function () {
        Route::get('jadwal-periksa', [CheckupScheduleController::class, 'index'])
            ->name('index');

        Route::put('jadwal-periksa/{id}', [CheckupScheduleController::class, 'update'])
            ->name('update');
    }
);

/*
|--------------------------------------------------------------------------
| Daftar Pasien
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'doctor.patient-list.',
        'middleware' => ['auth', 'role:Dokter'],
        'prefix' => 'dokter',
    ],
    function () {
        Route::get('daftar-pasien/datatable', [PatientListController::class, 'datatable'])
            ->name('datatable');

        Route::resource('daftar-pasien', PatientListController::class);
    }
);

/*
|--------------------------------------------------------------------------
| Riwayat Pasien
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'as' => 'doctor.patient-history.',
        'middleware' => ['auth', 'role:Dokter'],
        'prefix' => 'dokter',
    ],
    function () {
        Route::get('riwayat-pasien/datatable', [PatientHistoryController::class, 'datatable'])
            ->name('datatable');

        Route::resource('riwayat-pasien', PatientHistoryController::class);
    }
);

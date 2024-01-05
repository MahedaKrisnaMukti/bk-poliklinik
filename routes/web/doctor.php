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
        Route::get('daftar-pasien', [PatientListController::class, 'index'])
            ->name('index');

        Route::get('daftar-pasien/datatable', [PatientListController::class, 'datatable'])
            ->name('datatable');

        Route::get('daftar-pasien/{id}/edit', [PatientListController::class, 'edit'])
            ->name('edit');

        Route::post('daftar-pasien/tambah-obat', [PatientListController::class, 'addMedicine'])
            ->name('addMedicine');

        Route::post('daftar-pasien/hapus-obat', [PatientListController::class, 'removeMedicine'])
            ->name('removeMedicine');

        Route::put('daftar-pasien/{id}', [PatientListController::class, 'update'])
            ->name('update');
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
        Route::get('riwayat-pasien', [PatientHistoryController::class, 'index'])
            ->name('index');

        Route::get('riwayat-pasien/datatable', [PatientHistoryController::class, 'datatable'])
            ->name('datatable');

        Route::get('riwayat-pasien/{id}', [PatientHistoryController::class, 'show'])
            ->name('show');
    }
);

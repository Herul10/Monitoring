
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\MonitoringKehadiranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\Admin\PengumumanController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');


/*
|--------------------------------------------------------------------------
| AREA YANG HARUS LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | PENGUMUMAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/pengumuman', [
        PengumumanController::class,
        'index'
    ])->name('admin.pengumuman.index');

    Route::get('/admin/pengumuman/create', [
        PengumumanController::class,
        'create'
    ])->name('admin.pengumuman.create');

    Route::post('/admin/pengumuman', [
        PengumumanController::class,
        'store'
    ])->name('admin.pengumuman.store');

    Route::get('/admin/pengumuman/{id}/edit', [
        PengumumanController::class,
        'edit'
    ])->name('admin.pengumuman.edit');

    Route::put('/admin/pengumuman/{id}', [
        PengumumanController::class,
        'update'
    ])->name('admin.pengumuman.update');

    Route::delete('/admin/pengumuman/{id}', [
        PengumumanController::class,
        'destroy'
    ])->name('admin.pengumuman.destroy');


    /*
    |--------------------------------------------------------------------------
    | NILAI AKADEMIK
    |--------------------------------------------------------------------------
    */

    Route::get('/nilai', [NilaiController::class, 'index'])
        ->name('nilai.index');

    Route::get('/nilai/create', [NilaiController::class, 'create'])
        ->name('nilai.create');

    Route::post('/nilai', [NilaiController::class, 'store'])
        ->name('nilai.store');

    Route::get('/nilai-saya', [NilaiController::class, 'siswa'])
        ->name('nilai.siswa');

    Route::get('/nilai/{id}/edit', [NilaiController::class, 'edit'])
        ->name('nilai.edit');

    Route::put('/nilai/{id}', [NilaiController::class, 'update'])
        ->name('nilai.update');

    Route::delete('/nilai/{id}', [NilaiController::class, 'destroy'])
        ->name('nilai.destroy');


    /*
    |--------------------------------------------------------------------------
    | MONITORING KEHADIRAN
    |--------------------------------------------------------------------------
    */

    Route::get('/monitoring-kehadiran', [
        MonitoringKehadiranController::class,
        'index'
    ])->name('monitoring.kehadiran');


    /*
    |--------------------------------------------------------------------------
    | KEHADIRAN SISWA
    |--------------------------------------------------------------------------
    */

    Route::get('/kehadiran', [
        KehadiranController::class,
        'siswa'
    ])->name('kehadiran.siswa');

    Route::post('/kehadiran', [
        KehadiranController::class,
        'store'
    ])->name('kehadiran.store');


    /*
    |--------------------------------------------------------------------------
    | DATA SISWA
    |--------------------------------------------------------------------------
    */

    Route::resource('siswa', SiswaController::class);


    /*
    |--------------------------------------------------------------------------
    | DATA GURU
    |--------------------------------------------------------------------------
    */

    Route::resource('guru', GuruController::class);


    /*
    |--------------------------------------------------------------------------
    | DATA KELAS
    |--------------------------------------------------------------------------
    */

    Route::get('/kelas', [KelasController::class, 'index'])
        ->name('kelas.index');

    Route::get('/kelas/create', [KelasController::class, 'create'])
        ->name('kelas.create');

    Route::post('/kelas', [KelasController::class, 'store'])
        ->name('kelas.store');

    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])
        ->name('kelas.edit');

    Route::put('/kelas/{id}', [KelasController::class, 'update'])
        ->name('kelas.update');

    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])
        ->name('kelas.destroy');


    /*
    |--------------------------------------------------------------------------
    | DATA MATA PELAJARAN
    |--------------------------------------------------------------------------
    */

    Route::get('/mata-pelajaran', [
        MataPelajaranController::class,
        'index'
    ])->name('mata-pelajaran.index');

    Route::get('/mata-pelajaran/create', [
        MataPelajaranController::class,
        'create'
    ])->name('mata-pelajaran.create');

    Route::post('/mata-pelajaran', [
        MataPelajaranController::class,
        'store'
    ])->name('mata-pelajaran.store');

    Route::get('/mata-pelajaran/{id}/edit', [
        MataPelajaranController::class,
        'edit'
    ])->name('mata-pelajaran.edit');

    Route::put('/mata-pelajaran/{id}', [
        MataPelajaranController::class,
        'update'
    ])->name('mata-pelajaran.update');

    Route::delete('/mata-pelajaran/{id}', [
        MataPelajaranController::class,
        'destroy'
    ])->name('mata-pelajaran.destroy');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});

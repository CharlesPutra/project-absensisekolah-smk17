<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IjinController;
use App\Http\Controllers\JadwalguruController;
use App\Http\Controllers\JadwalkaryawanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LaporanController;
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

//route login
Route::get('/', [AuthController::class, 'Showlogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);


//route middleware auth
Route::middleware('auth')->group(function () {
    //route home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //route jurusan
    Route::resource('jurusan', JurusanController::class);

    //route jadwal guru
    Route::resource('jadwalguru', JadwalguruController::class);

    //route jadwal karyawan 
    Route::resource('jadwalkaryawan', JadwalkaryawanController::class);

    //route guru
    Route::resource('guru', GuruController::class);

    //route ijin 
    Route::resource('ijin', IjinController::class);

    //route laporan 
    Route::get('showlapor', [LaporanController::class, 'Showlapor'])->name('laporan');
    Route::get('/laporan', [LaporanController::class, 'filter'])->name('laporan.filter');
    Route::get('/laporan/absensi/{id}', [LaporanController::class, 'detailAbsensi'])->name('laporan.absensi_detail');



    //export pdf satu orang
   Route::get('/absensi/{id}/export-pdf', [LaporanController::class, 'exportAbsensiPDF'])->name('absensi.export.pdf');

   //route print satu orang
   Route::get('/absensi/{id}/print', [LaporanController::class, 'printAbsensi'])->name('absensi.print');

   //route export pdf semua orang 
   Route::get('/absensi/export-semua-pdf', [LaporanController::class, 'exportSemuaGuruPDF'])->name('absensi.semua.export.pdf');

   //route print semua orang 
   Route::get('/absensi/print-semua', [LaporanController::class, 'printSemuaGuru'])->name('absensi.semua.print');



    //route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;


    Route::get('/', function () {
    return view('dasbord');
    })->name('home');


Route::resources('/prodi', ProdiController::class)->except(), 'index']);
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']);
Route::resource('mahasiswa', MahasiswaController::class);

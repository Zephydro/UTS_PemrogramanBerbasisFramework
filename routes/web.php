<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('mahasiswa/pdf', [MahasiswaController::class, 'generatePDF'])->name('mahasiswa.pdf');
Route::get('mahasiswa/excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.excel');
Route::resource('mahasiswa', MahasiswaController::class);

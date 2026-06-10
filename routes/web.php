<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('jurusan', JurusanController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::get('/mahasiswa/export-csv', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.export-csv');
    Route::get('/mahasiswa/print', [MahasiswaController::class, 'print'])->name('mahasiswa.print');
    Route::resource('mahasiswa', MahasiswaController::class);
});

require __DIR__.'/auth.php';
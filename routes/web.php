<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;  // ← Perhatikan ini, Controllers (jamak)
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Middleware auth diterapkan di sini
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('jurusan', JurusanController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    
    // Profile Routes - Perbaiki ini
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});

require __DIR__.'/auth.php';
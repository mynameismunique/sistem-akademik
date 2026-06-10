<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaApi;
use App\Http\Controllers\AuthController;

Route::apiResource('mahasiswa', MahasiswaAPI::class);
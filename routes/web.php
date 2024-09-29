<?php

use App\Http\Controllers\InstallerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('checkpoint', [InstallerController::class, 'checkpoint']);
Route::get('install', [InstallerController::class, 'index']);
Route::post('install', [InstallerController::class, 'store'])->name('install');

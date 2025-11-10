<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FuvarozoController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth:fuvarozo', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/munkak', [AdminController::class, 'index'])->name('munkak.index');
    Route::get('/munkak/create', [AdminController::class, 'create'])->name('munkak.create');
    Route::post('/munkak', [AdminController::class, 'store'])->name('munkak.store');
    Route::get('/munkak/{munka}/edit', [AdminController::class, 'edit'])->name('munkak.edit');
    Route::put('/munkak/{munka}', [AdminController::class, 'update'])->name('munkak.update');
    Route::delete('/munkak/{munka}', [AdminController::class, 'destroy'])->name('munkak.destroy');
});

// Fuvarozo routes
Route::middleware(['auth:fuvarozo'])->prefix('fuvarozo')->name('fuvarozo.')->group(function () {
    Route::get('/munkak', [FuvarozoController::class, 'index'])->name('munkak.index');
    Route::put('/munkak/{munka}/status', [FuvarozoController::class, 'updateStatus'])->name('munkak.updateStatus');
});
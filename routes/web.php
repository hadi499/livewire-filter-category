<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::get('/dashboard/{post:slug}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/{post:slug}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{post:slug}', [HomeController::class, 'show'])->name('show');

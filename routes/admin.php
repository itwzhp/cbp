<?php

use App\Domains\Admin\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

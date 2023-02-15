<?php

use App\Domains\Admin\Controllers\AdminController;
use App\Domains\Admin\Controllers\MaterialsController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
Route::get('/materials', [MaterialsController::class, 'index'])->name('materials.index');

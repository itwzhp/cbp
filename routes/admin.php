<?php

use App\Domains\Admin\Controllers\AdminController;
use App\Domains\Admin\Controllers\MaterialsController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

Route::prefix('/materials')
    ->as('materials.')
    ->group(function () {
        Route::get('/', [MaterialsController::class, 'index'])->name('index');
        Route::get('/create', [MaterialsController::class, 'create'])->name('create');
        Route::get('/create/{preset}', [MaterialsController::class, 'new'])->name('new');
        Route::get('/{material}', [MaterialsController::class, 'edit'])->name('edit');
    });

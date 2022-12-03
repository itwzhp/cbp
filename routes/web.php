<?php

use App\Domains\Materials\Controllers\DownloadMaterialController;
use App\Domains\Materials\Controllers\MaterialsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MaterialsController::class, 'index'])->name('materials.index');
Route::prefix('/materials')
    ->as('materials.')
    ->group(function () {
        Route::get('/{material:slug}', [MaterialsController::class, 'show'])->name('show');
        Route::get('/{material:slug}/download', DownloadMaterialController::class)->name('download');
    });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

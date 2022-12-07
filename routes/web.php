<?php

use App\Domains\Materials\Controllers\DownloadMaterialController;
use App\Domains\Materials\Controllers\MaterialsByTagController;
use App\Domains\Materials\Controllers\MaterialsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', WelcomeController::class)->name('welcome');

Route::prefix('/materials')
    ->as('materials.')
    ->group(function () {
        Route::get('/', [MaterialsController::class, 'index'])->name('index');
        Route::get('/{material:slug}', [MaterialsController::class, 'show'])->name('show');
        Route::get('/{material:slug}/download', DownloadMaterialController::class)->name('download');

        Route::get('/t/{tag:slug}', MaterialsByTagController::class)->name('tag');
    });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

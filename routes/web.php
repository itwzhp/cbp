<?php

use App\Domains\Materials\Controllers\MaterialsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MaterialsController::class, 'index'])->name('materials.index');
Route::get('/materials/{material:slug}', [MaterialsController::class, 'show'])->name('materials.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

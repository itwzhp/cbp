<?php

use App\Domains\Admin\Controllers\AdminController;
use App\Domains\Admin\Controllers\MaterialsController;
use App\Domains\Admin\Controllers\TagsController;
use App\Domains\Admin\Controllers\TaxonomiesController;
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
        Route::delete('/{material}', [MaterialsController::class, 'destroy'])->name('destroy');
    });

Route::prefix('/taxonomies')
    ->as('taxonomies.')
    ->group(function () {
        Route::get('/', [TaxonomiesController::class, 'index'])->name('index');
        Route::get('/list', [TaxonomiesController::class, 'list'])->name('list');
        Route::post('/', [TaxonomiesController::class, 'store'])->name('store');
        Route::delete('/{taxonomy}', [TaxonomiesController::class, 'destroy'])->name('delete');
        Route::post('/{taxonomy}', [TaxonomiesController::class, 'update'])->name('update');
    });

Route::prefix('/tags')
    ->as('tags.')
    ->group(function () {
        Route::delete('/{tag}', [TagsController::class, 'destroy'])->name('delete');
    });

<?php

use App\Domains\Admin\Controllers\AdminController;
use App\Domains\Materials\Controllers\Api\MaterialIndexController;
use App\Domains\Materials\Controllers\Api\MaterialShowController;
use App\Domains\Materials\Controllers\Api\TaxonomiesGroupsIndexController;
use App\Domains\Visuals\Controllers\IndexSlidersController;
use App\Http\Middleware\ForceJsonResponseMiddleware;
use Illuminate\Support\Facades\Route;

Route::name('api.')
    ->middleware([
        ForceJsonResponseMiddleware::class,
    ])
    ->group(function () {
        Route::name('materials.')
            ->prefix('materials/')
            ->group(function () {
                Route::get('/', MaterialIndexController::class)->name('index');
                Route::get('/{material}', MaterialShowController::class)->name('show');
            });

        Route::name('taxonomies.')
            ->prefix('taxonomies/')
            ->group(function () {
                Route::get('/', TaxonomiesGroupsIndexController::class)->name('index');
            });

        Route::get('sliders', IndexSlidersController::class)->name('sliders.index');

        Route::get('/auth', [AdminController::class, 'testAuth'])->name('test.auth');
        Route::get('/sanctum', [AdminController::class, 'testSanctum'])->name('test.sanctum');

    });

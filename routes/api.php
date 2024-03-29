<?php

use App\Domains\Materials\Controllers\Api\MaterialIndexController;
use App\Domains\Materials\Controllers\Api\MaterialShowController;
use App\Domains\Materials\Controllers\Api\TaxonomiesGroupsIndexController;
use Illuminate\Support\Facades\Route;

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

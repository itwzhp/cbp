<?php

use App\Domains\Materials\Controllers\Api\MaterialIndexController;
use App\Domains\Materials\Controllers\Api\MaterialShowController;
use App\Domains\Materials\Controllers\Api\TaxonomiesGroupsIndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

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
});

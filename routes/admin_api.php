<?php
// prefix: api/admin
// name: api.admin

use App\Domains\Admin\Controllers\Api\MaterialsIndexController;
use App\Domains\Admin\Controllers\Api\MaterialUpdateController;
use App\Domains\Users\Middlewares\UserCanEditMaterialMiddleware;
use Illuminate\Support\Facades\Route;

Route::name('materials.')
    ->prefix('materials')
    ->group(function () {
        Route::get('/', MaterialsIndexController::class)->name('index');

        Route::middleware(UserCanEditMaterialMiddleware::class)
            ->prefix('/{materials}')
            ->group(function () {
                Route::post('/', [MaterialUpdateController::class, 'update'])->name('update');
                Route::delete('/', [MaterialUpdateController::class, 'delete'])->name('destroy');
            });
    });

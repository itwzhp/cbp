<?php
// prefix: api/admin
// name: api.admin

use App\Domains\Admin\Controllers\Api\FieldsControllerAbstract;
use App\Domains\Admin\Controllers\Api\MaterialsIndexController;
use App\Domains\Admin\Controllers\Api\MaterialUpdateControllerAbstract;
use App\Domains\Admin\Controllers\Api\SetupsController;
use App\Domains\Admin\Controllers\Api\TagsControllerAbstract;
use App\Domains\Users\Middlewares\UserCanEditMaterialMiddleware;
use Illuminate\Support\Facades\Route;

Route::name('materials.')
    ->prefix('materials')
    ->group(function () {
        Route::get('/', MaterialsIndexController::class)->name('index');

        Route::middleware(UserCanEditMaterialMiddleware::class)
            ->prefix('/{material}')
            ->group(function () {
                Route::post('/', [MaterialUpdateControllerAbstract::class, 'update'])->name('update');
                Route::delete('/', [MaterialUpdateControllerAbstract::class, 'delete'])->name('destroy');

                Route::prefix('fields')
                    ->name('fields.')
                    ->group(function () {
                        Route::post('/', [FieldsControllerAbstract::class, 'store'])->name('store');
                        Route::post('/{field}', [FieldsControllerAbstract::class, 'update'])->name('update');
                        Route::delete('/{field}', [FieldsControllerAbstract::class, 'delete'])->name('destroy');
                    });

                Route::prefix('tags')
                    ->name('tags.')
                    ->group(function () {
                        Route::post('/{tag}', [TagsControllerAbstract::class, 'attach'])->name('attach');
                        Route::delete('/{tag}', [TagsControllerAbstract::class, 'detach'])->name('detach');
                    });

                Route::prefix('setups')
                    ->name('setups.')
                    ->group(function () {
                        Route::post('/', [SetupsController::class, 'store'])->name('store');
                        Route::post('/{setup}', [SetupsController::class, 'update'])->name('update');
                        Route::delete('/{setup}', [SetupsController::class, 'destroy'])->name('destroy');
                    });
            });
    });

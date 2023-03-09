<?php
// prefix: api/admin
// name: api.admin

use App\Domains\Admin\Controllers\Api\AttachmentsController;
use App\Domains\Admin\Controllers\Api\FieldsController;
use App\Domains\Admin\Controllers\Api\MaterialsIndexController;
use App\Domains\Admin\Controllers\Api\MaterialUpdateController;
use App\Domains\Admin\Controllers\Api\ScenariosController;
use App\Domains\Admin\Controllers\Api\SetupsController;
use App\Domains\Admin\Controllers\Api\TagsController;
use App\Domains\Files\Controllers\Admin\Api\UploadMaterialAttachmentsController;
use App\Domains\Users\Middlewares\UserCanEditMaterialMiddleware;
use Illuminate\Support\Facades\Route;

Route::name('materials.')
    ->prefix('materials')
    ->group(function () {
        Route::get('/', MaterialsIndexController::class)->name('index');

        Route::middleware(UserCanEditMaterialMiddleware::class)
            ->prefix('/{material}')
            ->group(function () {
                Route::post('/', [MaterialUpdateController::class, 'update'])->name('update');
                Route::delete('/', [MaterialUpdateController::class, 'delete'])->name('destroy');

                Route::prefix('fields')
                    ->name('fields.')
                    ->group(function () {
                        Route::post('/', [FieldsController::class, 'store'])->name('store');
                        Route::post('/{field}', [FieldsController::class, 'update'])->name('update');
                        Route::delete('/{field}', [FieldsController::class, 'delete'])->name('destroy');
                    });

                Route::prefix('tags')
                    ->name('tags.')
                    ->group(function () {
                        Route::post('/{tag}', [TagsController::class, 'attach'])->name('attach');
                        Route::delete('/{tag}', [TagsController::class, 'detach'])->name('detach');
                    });

                Route::prefix('setups')
                    ->name('setups.')
                    ->group(function () {
                        Route::post('/', [SetupsController::class, 'store'])->name('store');
                        Route::post('/{setup}', [SetupsController::class, 'update'])->name('update');
                        Route::delete('/{setup}', [SetupsController::class, 'destroy'])->name('destroy');
                    });

                Route::prefix('attachments')
                    ->name('attachments.')
                    ->group(function () {
                        Route::post('/', [UploadMaterialAttachmentsController::class, 'upload'])->name('store');
                        Route::get('/{attachment}', [AttachmentsController::class, 'download'])->name('show');
                        Route::delete('/{attachment}', [AttachmentsController::class, 'destroy'])->name('destroy');
                        Route::post('/{attachment}', [AttachmentsController::class, 'update'])->name('update');
                    });

                Route::prefix('scenarios')
                    ->name('scenarios.')
                    ->controller(ScenariosController::class)
                    ->group(function () {
                        Route::post('/', 'store')->name('store');
                        Route::post('/{scenario}', 'update')->name('update');
                        Route::delete('/{scenario}', 'destroy')->name('destroy');
                    });
            });
    });

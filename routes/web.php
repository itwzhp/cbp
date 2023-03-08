<?php

use App\Domains\Files\Controllers\DownloadAttachmentController;
use App\Domains\Materials\Controllers\DownloadMaterialController;
use App\Domains\Materials\Controllers\MaterialsByOwnerController;
use App\Domains\Materials\Controllers\MaterialsByTagController;
use App\Domains\Materials\Controllers\MaterialsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WelcomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomePageController::class)->name('welcome');
Route::get('/o-cbp', [PagesController::class, 'about'])->name('about');

Route::prefix('/m')
    ->as('materials.')
    ->group(function () {
        Route::get('/', [MaterialsController::class, 'index'])->name('index');
        Route::get('/{material:slug}', [MaterialsController::class, 'show'])->name('show');
        Route::get('/{material:slug}/download', DownloadMaterialController::class)->name('download');

        Route::get('/t/{tag:slug}/{subtag:slug?}', MaterialsByTagController::class)->name('tag');
        Route::get('/o/{user}', MaterialsByOwnerController::class)->name('owner');
    });

Route::prefix('/attachments')
    ->as('attachments.')
    ->group(function () {
        Route::get('/{attachment}', DownloadAttachmentController::class)->name('download');
    });

require __DIR__ . '/auth.php';

Route::get('/test', TestController::class);
Route::get('/clear', [TestController::class, 'clearCache']);

require __DIR__ . '/backward_compatibility.php';

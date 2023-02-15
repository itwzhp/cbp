<?php
// prefix: api/admin
// name: api.admin

use App\Domains\Admin\Controllers\MaterialsIndexController;
use Illuminate\Support\Facades\Route;

Route::name('materials.')
    ->prefix('materials')
    ->group(function () {
        Route::get('/', MaterialsIndexController::class)->name('index');
    });

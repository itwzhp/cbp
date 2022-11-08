<?php

use App\Domains\Materials\Controllers\Api\MaterialIndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('materials.')
    ->prefix('materials/')
    ->group(function () {
        Route::get('/', MaterialIndexController::class);
    });

<?php

use App\Domains\Materials\Controllers\MaterialBackwardCompatibilityController;
use Illuminate\Support\Facades\Route;

Route::get('/{type}/{material?}', MaterialBackwardCompatibilityController::class);

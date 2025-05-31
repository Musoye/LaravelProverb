<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProverbController;

Route::apiResource('proverbs', ProverbController::class);

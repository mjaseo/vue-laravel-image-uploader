<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImageController::class, 'index']);
Route::get('/images', [ImageController::class, 'show']);
Route::post('/upload', [ImageController::class, 'store']);

Route::get('/assignment', [AssignmentController::class, 'index']);

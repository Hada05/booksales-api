<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware(['auth:api'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/books', BookController::class)->only(['store', 'update', 'destroy']);
        Route::resource('/genres', GenreController::class)->only(['store', 'update', 'destroy']);
        Route::resource('/authors', AuthorController::class)->only(['store', 'update', 'destroy']);
    });
});

Route::resource('/books', BookController::class)->only(['index', 'show']);

Route::resource('/genres', GenreController::class)->only(['index', 'show']);

Route::resource('/authors', AuthorController::class)->only(['index', 'show']);

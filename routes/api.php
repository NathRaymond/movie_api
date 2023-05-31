<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('movies', [MovieController::class, 'index']);
Route::post('store_movies', [MovieController::class, 'store']);
Route::get('show_movies/{id}', [MovieController::class, 'show']);
Route::get('movies/{id}/edit', [MovieController::class, 'edit']);
Route::post('movies/{id}/edit', [MovieController::class, 'update']);
Route::delete('movies/{id}/delete', [MovieController::class, 'destroy']);

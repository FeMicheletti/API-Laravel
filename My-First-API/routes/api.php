<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteMusicController;

Route::get('/favorites', [FavoriteMusicController::class, 'listAllFavoriteMusic']);
Route::post('/favorites', [FavoriteMusicController::class, 'createFavoriteMusic']);
Route::put('/favorites/{id}', [FavoriteMusicController::class, 'updateFavoriteMusicById']);
Route::patch('/favorites/{id}', [FavoriteMusicController::class, 'patchFavoriteMusicById']);
Route::delete('/favorites/{id}', [FavoriteMusicController::class, 'deleteFavoriteMusicById']);
Route::fallback(function () {
    return response()->json(array('error' => 'Not Found'), 404);
});
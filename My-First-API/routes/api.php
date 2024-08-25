<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteMusicController;

Route::get('/favorites', [FavoriteMusicController::class, 'listAllFavoriteMusic']);
Route::post('/favorites', [FavoriteMusicController::class, 'createFavoriteMusic']);
Route::put('/favorites/{id}', [FavoriteMusicController::class, 'updateFavoriteMusicById']);
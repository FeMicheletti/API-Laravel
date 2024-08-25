<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteMusicRequest;
use App\Models\FavoriteMusic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteMusicController extends Controller {
    //* Method GET
    public function listAllFavoriteMusic() {
        $favorites = FavoriteMusic::All();

        return response()->json(array('data' => $favorites));
    }

    //* Method POST
    public function createFavoriteMusic(FavoriteMusicRequest $request) {
        $favorite = array();

        $valideMusic = FavoriteMusic::where('name', $request->name)->orWhere('artist', $request->artist)->first();
        if ($valideMusic) return response()->json(['error' => 'Invalid input. Please check your parameters.'], 400);

        $existingMusic = FavoriteMusic::where('tier', $request->tier)->first();
        DB::transaction(function () use ($request, $existingMusic, &$favorite) {
            if ($existingMusic) FavoriteMusic::where('tier', '>=', $request->tier)->increment('tier');
            $favorite = FavoriteMusic::create($request->validated());
        });

        return response()->json(array('data' => $favorite), 201);
    }

    //* Method PUT
    public function updateFavoriteMusicById(FavoriteMusicRequest $request, $id) {
        $favorite = FavoriteMusic::findOrFail($id);

        DB::transaction(function () use ($request, $favorite) {
            FavoriteMusic::where('tier', '>=', $request->tier)->increment('tier');
            $favorite->update($request->all());
        });

        return response()->json(array('data' => $favorite), 200);
    }
}

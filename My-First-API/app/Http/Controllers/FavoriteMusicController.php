<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteMusicRequest;
use App\Http\Requests\FavoritePatchRequest;
use Illuminate\Http\Request;
use App\Models\FavoriteMusic;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class FavoriteMusicController extends Controller {
    //* Method GET
    public function listAllFavoriteMusic(Request $request) {
        $orderBy   = $request->query("orderBy", "tier");
        $direction = $request->query("direction", "asc");

        $favorites = FavoriteMusic::orderBy($orderBy, $direction)->get();

        return response()->json(array("data" => $favorites));
    }

    //* Method POST
    public function createFavoriteMusic(FavoriteMusicRequest $request) {
        $favorite = array();

        $valideMusic = FavoriteMusic::where("name", $request->name)->where("artist", $request->artist)->first();
        if ($valideMusic) return response()->json(["error" => "Invalid input. Please check your parameters."], 400);

        $existingMusic = FavoriteMusic::where("tier", $request->tier)->first();
        DB::transaction(function () use ($request, $existingMusic, &$favorite) {
            if ($existingMusic) FavoriteMusic::where("tier", ">=", $request->tier)->increment("tier");
            $favorite = FavoriteMusic::create($request->validated());
        });

        return response()->json(array("data" => $favorite), 201);
    }

    //* Method PUT
    public function updateFavoriteMusicById(FavoriteMusicRequest $request, $id) {
        try {
            $favorite = FavoriteMusic::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(array("error" => "Invalid input. Please check your parameters."), 400);
        }

        DB::transaction(function () use ($request, $favorite) {
            FavoriteMusic::where("tier", ">", $request->tier)->increment("tier");
            $favorite->update($request->all());
        });

        return response()->json(array("data" => $favorite), 200);
    }

    //* Method PATCH
    public function patchFavoriteMusicById(FavoritePatchRequest $request, $id) {
        try {
            $favorite = FavoriteMusic::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(array("error" => "Invalid input. Please check your parameters."), 400);
        }

        DB::transaction(function() use ($request, $favorite) {
            if ($request->tier) FavoriteMusic::where("tier", ">=", $request->tier)->increment("tier");
            $favorite->update($request->all());
        });

        return response()->json(array("data" => $favorite), 200);
    }

    //* Method DELETE
    public function deleteFavoriteMusicById(FavoriteMusicRequest $request, $id) {
        try {
            $favorite = FavoriteMusic::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(array("error" => "Invalid input. Please check your parameters."), 400);
        }

        DB::transaction(function() use ($favorite) {
            $favorite->delete();
        });

        return response()->json(array("message" => "Favorite music deleted successfully."), 200);
    }
}
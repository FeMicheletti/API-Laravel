<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteMusicRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'tier' => 'required|integer|min:1',
        ];
    }
}

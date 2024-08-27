<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoritePatchRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'string|max:255',
            'artist' => 'string|max:255',
            'tier' => 'integer|min:1',
        ];
    }
}

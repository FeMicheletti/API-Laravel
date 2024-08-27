<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteMusic extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'favorite_music';
    protected $fillable = ['name', 'artist', 'tier'];
}

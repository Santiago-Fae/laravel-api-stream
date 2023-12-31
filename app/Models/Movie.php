<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'id_genre',
        'release_date',
    ];
    public function ratings()
    {
        return $this->belongsToMany(Rating::class, 'users_movies_rating', 'id_movie', 'id_user');
    }
    public function genre() {
        return $this->belongsTo(Genre::class, 'id_genre');
    }
}

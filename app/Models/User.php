<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function movies() {
        return $this->belongsToMany(Movie::class);
    }
    public function ratings()
    {
        return $this->belongsToMany(Rating::class, 'users_movies_rating', 'id_user', 'id_movie');
    }
}

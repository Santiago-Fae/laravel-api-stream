<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'users_movies_rating';

    protected $fillable = ['id_user', 'id_movie', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movie');
    }
}

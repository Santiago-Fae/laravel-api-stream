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
    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function genre() {
        return $this->belongsTo(Genre::class, 'id_genre');
    }
}

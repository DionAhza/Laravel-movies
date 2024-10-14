<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre',
        'director',
        'release_year',
        'link',
        'synopsis',
        'duration',
        'thumbnail',
    ];
    

    // Relasi ke model Genre
    public function genres()
{
    return $this->belongsToMany(Genre::class);
}
public function ratings()
{
    return $this->hasMany(Rating::class);
}

// Fungsi untuk menghitung rata-rata rating
public function averageRating()
{
    return $this->ratings()->avg('rating');
}
}

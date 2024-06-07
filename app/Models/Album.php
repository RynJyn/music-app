<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'genre',
        'art',
        'released',
        'artist_id'
    ];

    public function artist(){
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function tracks(){
        return $this->hasMany(Track::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'duration',
        'filename',
        'album_id'
    ];

    public function album(){
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function artist(){
        return $this->hasOneThrough(Artist::class, Album::class, 'id', 'id', 'album_id', 'artist_id');
    }
}

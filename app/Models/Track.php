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

    public function albums(){
        return $this->belongsTo(Album::class);
    }
}

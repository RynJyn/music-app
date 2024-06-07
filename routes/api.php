<?php 
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::get('/api/artists/', [ArtistController::class, 'query'])->name('artists.api');
Route::get('/api/albums/', [AlbumController::class, 'query'])->name('albums.api');
Route::get('/api/track/', [TrackController::class, 'single'])->name('track.api');

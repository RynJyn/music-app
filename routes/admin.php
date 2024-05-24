<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TrackController;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function(){
    Route::get('/admin', function(){
        return Inertia::render('Admin/Edit');
    })->name('admin.new');

    Route::prefix('admin')->group(function(){
        Route::get('/artists/', function(){
            return Inertia::render('Admin/Artists', [
                'artists' => Artist::paginate(10)->through(function($artist){
                    return [
                        'id' => $artist->id,
                        'name' => $artist->name
                    ];
                })
            ]);
        })->name('admin.artists');

        Route::put('/artist/new', [ArtistController::class, 'store'])->name('artist.new');
        Route::get('/artist/{artist}/edit', [ArtistController::class, 'edit'])->name('artist.edit');
        Route::patch('/artist/{artist}/edit', [ArtistController::class, 'update'])->name('artist.update');
        Route::delete('/artist/{artist}/delete', [ArtistController::class, 'destroy'])->name('artist.delete');

        Route::get('/albums/', function(){
            return Inertia::render('Admin/Albums', [
                'albums' => Album::paginate(10)->through(function($album){
                    return [
                        'id' => $album->id,
                        'title' => $album->title
                    ];
                })
            ]);
        })->name('admin.albums');
        
        Route::put('/album/new', [AlbumController::class, 'store'])->name('album.new');
        Route::get('/album/{album}/edit', [AlbumController::class, 'edit'])->name('album.edit');
        Route::patch('/album/{album}/edit', [AlbumController::class, 'update'])->name('album.update');
        Route::delete('/album/{album}/delete', [AlbumController::class, 'destroy'])->name('album.delete');

        Route::get('/tracks/', function(){
            return Inertia::render('Admin/Tracks', [
                'tracks' => Track::paginate(10)->through(function($track){
                    return [
                        'id' => $track->id,
                        'title' => $track->title,
                        'duration' => $track->duration
                    ];
                })
            ]);
        })->name('admin.tracks');

        Route::put('/track/new', [TrackController::class, 'store'])->name('track.new');
        Route::get('/track/{track}/edit', [TrackController::class, 'edit'])->name('track.edit');
        Route::patch('/track/{track}/edit', [TrackController::class, 'update'])->name('track.update');
        Route::delete('/track/{track}/delete', [TrackController::class, 'destroy'])->name('track.delete');
    });
});
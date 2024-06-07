<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Artist;
use App\Models\Album;
use App\Models\Track;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'albums' => Album::select('id', 'title', 'art')->orderBy('released', 'desc')->limit(10)->get()
    ]);
})->name('home');

Route::get('/search', function() {
    return Inertia::render('Search', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'artists' => Artist::select('id', 'name', 'photo')->limit(10)->get(),
        'genres' => Artist::select('genre')->distinct()->limit(10)->get()
    ]);
})->name('search');

Route::get('/search/{query}', function($query) {
    return Inertia::render('Results', [
        'results' => [
            'artists' => Artist::select('id', 'name', 'photo')->limit(10)->where('name', 'LIKE', '%' . $query . '%')->get(),
            'albums' => Album::select('id', 'title', 'art')->limit(10)->where('title', 'LIKE', '%' . $query . '%')->get(),
            'trackSearch' => [
                'tracks' => Track::select('id', 'title', 'duration', 'filename')->limit(20)->where('title', 'LIKE', '%' . $query . '%')->get()
            ]
        ]
    ]);
})->name('results');

Route::get('/artist/{id}', function($id){
    $albums = Album::select('id', 'title', 'genre', 'art', 'released')->where('artist_id', $id)->get()->each(function($album){
        $album['tracks'] = Track::select('id', 'title', 'duration', 'filename')->where('album_id', $album['id'])->get();
    });

    return Inertia::render('Artist', [
        'artist' => Artist::select('id', 'name', 'genre')->where('id', $id)->first(),
        'results' => $albums
    ]);
})->name('artist');

Route::get('/album/{id}', function($id){
    $album = Album::select('id', 'title', 'genre', 'art', 'released', 'artist_id')->where('id', $id)->first();
    $res = [
        'artist' => Artist::select('id', 'name', 'photo')->where('id', $album['artist_id'])->first(),
        'album' => $album,
        'tracks' => Track::select('id', 'title', 'duration', 'filename')->where('album_id', $id)->get()
    ];

    unset($res['album']['artist_id']);

    return Inertia::render('Album', $res);
})->name('album');

Route::get('/genre/{genre}', function(){
    return Inertia::render('Search');
})->name('genre');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/laravel', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/api.php';

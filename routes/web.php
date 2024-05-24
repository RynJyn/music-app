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
        'canRegister' => Route::has('register')
    ]);
})->name('home');

Route::get('/search', function() {
    return Inertia::render('Search', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'artists' => Artist::select('id', 'name', 'photo')->get(),
        'genres' => Artist::select('genre')->distinct()->get()
    ]);
})->name('search');

Route::get('/artist/{id}', function($id){
    $albums = Album::select('id', 'title', 'genre', 'art', 'released')->where('artist_id', $id)->get()->each(function($album){
        $album['tracks'] = Track::select('id', 'title', 'duration', 'filename')->where('album_id', $album['id'])->get();
    });

    return Inertia::render('Artist', [
        'artist' => Artist::select('id', 'name', 'genre')->where('id', $id)->first(),
        'results' => $albums
    ]);
})->name('artist');

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

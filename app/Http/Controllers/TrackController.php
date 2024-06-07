<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Builder;

class TrackController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'title' => "required|string",
            'duration' => "required|string",
            'file' => "required|string",
            'album_id' => "required|string|exists:App\Models\Album,id"
        ]);

        Track::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'filename' => $request->file,
            'album_id' => $request->album_id
        ]);
    }

    public function edit(Track $track){
        return Inertia::render('Admin/TrackEdit', [
            'track' => $track
        ]);
    }

    public function update(Request $request, Track $track){
        $updated = $request->validate([
            'title' => "required|string",
            'duration' => "required|string",
            'filename' => "required|string",
            'album_id' => "required|integer|exists:App\Models\Album,id"
        ]);

        $track->update($updated);
    }

    public function destroy(Track $track){
        $track->delete();

        return Redirect::route('admin.tracks');
    }

    public function single(Request $request){
        $request->validate([
            'id' => "required|integer|exists:App\Models\Track,id",
            'artist' => "boolean",
            'album' => "boolean"
        ]);

        $album = $request->input('album');
        $artist = $request->input('artist');

        $result = Track::when($album, function(Builder $query, bool $album){
            $query->with('album');
        })->when($artist, function(Builder $query, bool $artist){
            $query->with('artist');
        })->find($request->input('id'), ['filename', 'album_id']);
        return response()->json($result);
    }
}

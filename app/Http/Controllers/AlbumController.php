<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AlbumController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'title' => "required|string",
            'genre' => "required|string",
            'released' => "required|date",
            'artist_id' => "required|string|exists:App\Models\Artist,id"
        ]);

        Album::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'released' => $request->released,
            'art' => "example.jpg",
            'artist_id' => $request->artist_id
        ]);
    }

    public function edit(Album $album){
        return Inertia::render('Admin/AlbumEdit', [
            'album' => $album
        ]);
    }

    public function update(Request $request, Album $album){
        $updated = $request->validate([
            'title' => "required|string",
            'genre' => "required|string",
            'released' => "required|date",
            'artist_id' => "required|integer|exists:App\Models\Artist,id"
        ]);

        $album->update($updated);
    }

    public function destroy(Album $album){
        $album->delete();

        return Redirect::route('admin.albums');
    }

    public function query(Request $request){
        $result = [
            'albums' => Album::select('id', 'title', 'artist_id')->where('title', "LIKE", '%' . $request->input('title') . '%')->get()->each(function($album){
                $album['artist'] = Artist::select('name')->where('id', $album['artist_id'])->first();
            })
        ];

        return response()->json($result);
    }
}

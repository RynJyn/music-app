<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Artist;
use Inertia\Inertia;

class ArtistController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name' => "required|string|unique:".Artist::class,
            'genre' => "required|string"
            //'photo' => "required"
        ]);

        //$filepath = $request->file('photo')->store('public');

        Artist::create([
            'name' => $request->name,
            'genre' => $request->genre,
            'photo' => "example.png"
        ]);
    }

    public function edit(Artist $artist){
        return Inertia::render(
            'Admin/ArtistEdit',
            [
                'artist' => $artist
            ]
        );
    }

    public function update(Request $request, Artist $artist){
        $updated = $request->validate([
            //'name' => "required|string|unique:".Artist::class.",name,".$artist->id,
            'name' => "required|string|unique:artists,name,".$artist->id,
            'genre' => "required|string"
            //'photo' => "required"
        ]);

        $artist->update($updated);

        return redirect()->back();
    }

    public function destroy(Artist $artist){
        $artist->delete();

        return Redirect::route('admin.artists');
    }

    public function query(Request $request){
        $result = [
            'artists' => Artist::select('id', 'name')->where('name', "LIKE", '%' . $request->input('name') . '%')->get()
        ];

        return response()->json($result);
    }
}

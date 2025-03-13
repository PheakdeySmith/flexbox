<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::all();
        return view('backend.playlist.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $movies = Movie::all();
        return view('backend.playlist.create', compact('users', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'movies' => 'required|array', // Ensure movies is an array
            'movies.*' => 'exists:movies,id', // Ensure each movie exists
        ]);

        // Create the playlist
        $playlist = Playlist::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Attach selected movies to the playlist
        $playlist->movies()->attach($request->movies);

        return redirect()->route('playlist.index')->with('success', 'Playlist created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('backend.playlist.show', compact('playlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('backend.playlist.edit', compact('playlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->update($request->all());
        return redirect()->route('playlist.index')->with('success', 'Playlist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return redirect()->route('playlist.index')->with('success', 'Playlist deleted successfully');
    }
}

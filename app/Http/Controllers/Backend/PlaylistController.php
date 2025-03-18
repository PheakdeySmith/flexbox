<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        $playlists = Playlist::paginate(15);
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Assign authenticated user if user_id is missing
        $user_id = auth()->id();

        // Create the playlist
        $playlist = Playlist::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect based on the source of the request
        if ($request->source === 'frontend') {
            return redirect()->route('frontend.watchlist')->with('success', 'Playlist created successfully.');
        }

        return redirect()->route('playlist.index')->with('success', 'Playlist created successfully.');
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
    public function edit(Playlist $playlist)
    {
        $movies = Movie::orderBy('title')->get();
        return view('backend.playlist.edit', compact('playlist', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'movies' => 'required|array',
            'movies.*' => 'exists:movies,id',
        ]);

        $playlist = Playlist::findOrFail($id);

        // Update the basic playlist information
        $playlist->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Sync the movies (this will update the pivot table)
        $playlist->movies()->sync($request->movies);

        return redirect()->route('playlist.index')->with('success', 'Playlist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();

        if ($request->has('source') && $request->source === 'frontend') {
            return redirect()->route('frontend.watchlist')
                ->with('success', 'Playlist deleted successfully');
        }


        return redirect()->route('playlist.index')->with('success', 'Playlist deleted successfully');
    }

    public function removeMovie($playlistId, $movieId, Request $request)
    {
        try {
            $playlist = Playlist::findOrFail($playlistId);
            $playlist->movies()->detach($movieId); // Remove the movie from the playlist

            // Check if the request is coming from the frontend
            if ($request->has('source') && $request->source === 'frontend') {
                return redirect()->route('frontend.playlistDetail', $playlistId)
                    ->with('success', 'Movie removed from playlist.');
            }

            // Redirect to the backend playlist index if not from frontend
            return redirect()->route('playlist.index')->with('success', 'Movie removed from playlist.');
        } catch (\Exception $e) {
            // Redirect back to frontend on error
            return redirect()->route('frontend.playlistDetail', $playlistId)
                ->with('error', 'Failed to remove movie: ' . $e->getMessage());
        }
    }
}

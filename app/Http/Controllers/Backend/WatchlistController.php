<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watchlists = Watchlist::with(['user', 'movie'])->latest()->paginate(10);
        return view('backend.watchlist.index', compact('watchlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $movies = Movie::all();
        return view('backend.watchlist.create', compact('users', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id', // Change from 'movies' to 'movie_id'
        ]);

        // Check if the user already has a default playlist (or create one)
        $playlist = Playlist::firstOrCreate(
            ['user_id' => $request->user_id, 'name' => 'My Playlist'], // Default playlist name
            ['description' => 'Automatically created playlist']
        );

        // Attach the movie to the playlist (avoid duplicates)
        if (!$playlist->movies()->where('movie_id', $request->movie_id)->exists()) {
            $playlist->movies()->attach($request->movie_id);
        }

        // Redirect to the playlist page
        return redirect()->route('frontend.playlist')->with('success', 'Movie added to your playlist successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Watchlist $watchlist)
    {
        $watchlist->load(['user', 'movie']);
        return view('backend.watchlist.show', compact('watchlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Watchlist $watchlist)
    {
        $users = User::all();
        $movies = Movie::all();
        return view('backend.watchlist.edit', compact('watchlist', 'users', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Watchlist $watchlist)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Check if the watchlist entry already exists for another entry
        $exists = Watchlist::where('user_id', $request->user_id)
            ->where('movie_id', $request->movie_id)
            ->where('id', '!=', $watchlist->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This movie is already in the user\'s watchlist.');
        }

        $watchlist->update([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
        ]);

        return redirect()->route('watchlist.index')->with('success', 'Watchlist entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchlist $watchlist)
    {
        $watchlist->delete();
        return redirect()->route('watchlist.index')->with('success', 'Watchlist entry removed successfully.');
    }

    /**
     * Toggle a movie in the current user's watchlist.
     */
    public function toggle(Request $request, Movie $movie)
    {
        $user = Auth::user();

        $watchlistItem = Watchlist::where('user_id', $user->id)
            ->where('movie_id', $movie->id)
            ->first();

        if ($watchlistItem) {
            $watchlistItem->delete();
            $message = 'Movie removed from your watchlist.';
            $added = false;
        } else {
            Watchlist::create([
                'user_id' => $user->id,
                'movie_id' => $movie->id,
                'added_at' => now(),
            ]);
            $message = 'Movie added to your watchlist.';
            $added = true;
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'added' => $added,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}

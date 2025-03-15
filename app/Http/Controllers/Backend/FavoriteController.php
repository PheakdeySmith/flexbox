<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::all();
        $movies = Movie::all();
        $users = User::all();
        return view('backend.favorite.index', compact('favorites', 'movies', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $movies = Movie::all();
        return view('backend.favorite.create', compact('users', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Check if the movie is already favorited
        $favorite = Favorite::where('user_id', $request->user_id)
            ->where('movie_id', $request->movie_id)
            ->first();

        if ($favorite) {
            // Remove from favorites if already added
            $favorite->delete();
            return redirect()->route('favorite.index')->with('success', 'Removed from favorites successfully.');
        } else {
            // Add to favorites
            Favorite::create($request->all());
            return redirect()->route('favorite.index')->with('success', 'Added to favorites successfully.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $favorite = Favorite::findOrFail($id);
        $user = User::findOrFail($favorite->user_id);
        $movie = Movie::findOrFail($favorite->movie_id);
        return view('backend.favorite.show', compact('favorite', 'user', 'movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $favorite = Favorite::findOrFail($id);
        $users = User::all();
        $movies = Movie::all();
        return view('backend.favorite.edit', compact('favorite', 'users', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $favorite = Favorite::findOrFail($id);
        $favorite->update($request->all());
        return redirect()->route('favorite.index')->with('success', 'Favorite updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $favorite = Favorite::findOrFail($id);
            $favorite->delete();
            if ($request->has('source') && $request->source === 'frontend') {
                return redirect()->route('frontend.watchlist')
                    ->with('success', 'Favorite deleted successfully.');
            }
            return redirect()->route('favorite.index')->with('success', 'Favorite deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('favorite.index')->with('error', 'Failed to delete favorite: ' . $e->getMessage());
        }
    }
}

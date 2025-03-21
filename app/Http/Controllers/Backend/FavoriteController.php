<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $favorites = Favorite::paginate(15);
        $movies = Movie::all();
        $users = User::all();
        return view('backend.favorite.index', compact('favorites', 'movies', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
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
            'movie_id' => 'required|exists:movies,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = Auth::id();
        $movieId = $request->movie_id;


        $exists = Favorite::where('user_id', $request->user_id)
            ->where('movie_id', $request->movie_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'This movie is already in your favorite.');
        }


        $favorite = Favorite::create([
            'user_id' => $userId,
            'movie_id' => $movieId,

        ]);

        if ($request->source === 'frontend') {
            return redirect()->route('frontend.watchlist')->with('success', 'Movie added to your favorite successfully.');
        }

        return redirect()->route('favorite.index')->with('success', 'Favorite created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
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
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
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
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
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

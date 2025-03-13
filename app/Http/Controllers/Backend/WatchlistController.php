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
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Check if the watchlist entry already exists
        $exists = Watchlist::where('user_id', $request->user_id)
            ->where('movie_id', $request->movie_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This movie is already in the user\'s watchlist.');
        }

        Watchlist::create([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'added_at' => now(),
        ]);
         // Check if the logged-in user is an admin
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.watchlist')->with('success', 'Movie added to watchlist successfully.');
    }

    // Default: Redirect to frontend watchlist
    return redirect()->route('frontend.watchlist')->with('success', 'Movie added to watchlist successfully.');
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

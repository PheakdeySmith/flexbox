<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class WatchlistController extends Controller
{
    public function index()
    {
        $watchlists = Auth::user()->watchlists()
            ->with('movie')  // Eager load the movie relationship
            ->latest()       // Order by most recently added
            ->get();

        $playlists = Auth::user()->playlists()
            ->with('movie')  // Eager load the movie relationship
            ->latest()       // Order by most recently added
            ->get();

        return view('frontend.watchlist.index', compact('watchlists', 'playlists'));
    }
}

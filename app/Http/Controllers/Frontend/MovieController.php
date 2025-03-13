<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function watch(Movie $movie)
    {
        // Check if user has purchased this movie
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($movie) {
                $query->where('movie_id', $movie->id);
            })
            ->exists();

        if (!$hasPurchased) {
            return redirect()->route('frontend.detail', $movie->id)
                ->with('error', 'You need to purchase this movie before watching.');
        }

        return view('frontend.movies.watch', compact('movie'));
    }
}

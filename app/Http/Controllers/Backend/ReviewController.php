<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $reviews = Review::with(['user', 'movie'])->latest()->paginate(10);
        return view('backend.review.index', compact('reviews'));
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
        return view('backend.review.create', compact('users', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string',
            'contains_spoilers' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        // Check if the user has already reviewed this movie
        $exists = Review::where('user_id', $request->user_id)
            ->where('movie_id', $request->movie_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This user has already reviewed this movie.');
        }

        Review::create([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'contains_spoilers' => $request->contains_spoilers ?? false,
            'is_approved' => $request->is_approved ?? true,
        ]);

        // Check if request is from frontend
        if ($request->has('source') && $request->source === 'frontend') {
            return redirect()->route('frontend.detail', $request->movie_id)
                ->with('success', 'Your review has been submitted successfully.');
        }

        // Default backend redirect
        return redirect()->route('review.index')->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $review->load(['user', 'movie']);
        return view('backend.review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $users = User::all();
        $movies = Movie::all();
        return view('backend.review.edit', compact('review', 'users', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string',
            'contains_spoilers' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        // Check if another review exists for the same user and movie
        $exists = Review::where('user_id', $request->user_id)
            ->where('movie_id', $request->movie_id)
            ->where('id', '!=', $review->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This user has already reviewed this movie.');
        }

        $review->update([
            'user_id' => $request->user_id,
            'movie_id' => $request->movie_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'contains_spoilers' => $request->contains_spoilers ?? false,
            'is_approved' => $request->is_approved ?? true,
        ]);

        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $review->delete();
        return redirect()->route('review.index')->with('success', 'Review deleted successfully.');
    }

    /**
     * Toggle the approval status of a review.
     */
    public function toggleApproval(Review $review)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $review->update([
            'is_approved' => !$review->is_approved,
        ]);

        $status = $review->is_approved ? 'approved' : 'unapproved';
        return redirect()->back()->with('success', "Review {$status} successfully.");
    }

    /**
     * Submit a review for the current user.
     */
    public function submitReview(Request $request, Movie $movie)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'comment' => 'required|string|min:10',
            'contains_spoilers' => 'boolean',
            'name' => 'required_if:guest,1|string|max:255',
            'email' => 'required_if:guest,1|email|max:255',
        ]);

        // Check if user is logged in
        if (!Auth::check()) {
            // Handle guest review or redirect to login
            return redirect()->route('login')
                ->with('error', 'Please login to submit a review.');
        }

        $user = Auth::user();

        // Check if user has already reviewed this movie
        $existingReview = Review::where('user_id', $user->id)
            ->where('movie_id', $movie->id)
            ->first();

        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'You have already reviewed this movie.');
        }

        // Create the review
        Review::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'contains_spoilers' => $request->has('contains_spoilers'),
            'is_approved' => false, // Set to false by default, requiring admin approval
        ]);

        return redirect()->back()
            ->with('success', 'Thank you! Your review has been submitted and is awaiting approval.');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Playlist;
use App\Models\watchlist;
use App\Models\SubscriptionPlan;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FrontendController extends Controller
{
    public function index()
    {
        $recommendedMovies = Movie::where('status', 'active')
            ->where(function ($query) {
                $query->where('is_free', true)
                    ->orWhere('imdb_rating', '>=', 7);
            })
            ->take(10)
            ->get();

        $latestMovies = Movie::where('status', 'active')
            ->orderBy('release_date', 'desc')
            ->take(10)
            ->get();

        $popularMovies = Movie::where('status', 'active')
            ->orderBy('release_date', 'desc')
            ->take(10)
            ->get();

        $specials = Movie::where('status', 'active')
            ->where('is_free', true)
            ->take(10)
            ->get();

        $sliderMovies = Movie::where('status', 'active')
            ->where('is_featured', true)
            ->orderBy('release_date', 'desc')
            ->take(3)
            ->get();

        $topTenMovies = Movie::where('status', 'active')
            ->orderBy('imdb_rating', 'desc')
            ->take(10)
            ->get();

        $verticalSliderMovies = Movie::where('status', 'active')
            ->where('is_featured_vertical', true)
            ->orderBy('release_date', 'desc')
            ->take(4)
            ->get();

        $genres = Genre::orderBy('name')
            ->get();

        $actors = Actor::orderBy('name')
            ->take(20)
            ->get();

        return view('frontend.home.index', compact(
            'recommendedMovies',
            'latestMovies',
            'popularMovies',
            'specials',
            'sliderMovies',
            'verticalSliderMovies',
            'topTenMovies',
            'genres',
            'actors'
        ));
    }

    public function detail($id = null)
    {
        $playlists = Playlist::all();
        $recommendedMovies = Movie::where('status', 'active')
            ->where(function ($query) {
                $query->where('is_free', true)
                    ->orWhere('imdb_rating', '>=', 7);
            })
            ->take(10)
            ->get();

        $popularMovies = Movie::where('status', 'active')
            ->orderBy('release_date', 'desc')
            ->take(10)
            ->get();

        $movie = null;
        if ($id) {
            $movie = Movie::with(['actors', 'directors', 'genres'])->findOrFail($id);
        }

        return view('frontend.detail.index', compact('movie', 'recommendedMovies', 'popularMovies', 'playlists'));
    }

    public function viewAll(Request $request)
    {
        $section = $request->query('section', 'all');
        $genreId = $request->query('genre_id');
        $actorId = $request->query('actor_id');
        $title = 'All Movies';
        $movies = [];

        // Base query
        $query = Movie::where('status', 'active');

        // Filter by section
        switch ($section) {
            case 'recommended':
                $title = 'Recommended Movies';
                $query->where(function($q) {
                    $q->where('is_free', true)
                      ->orWhere('imdb_rating', '>=', 7);
                });
                break;

            case 'latest':
                $title = 'Latest Movies';
                $query->orderBy('release_date', 'desc');
                break;

            case 'popular':
                $title = 'Popular Movies';
                $query->orderBy('release_date', 'desc');
                break;

            case 'top_rated':
                $title = 'Top Rated Movies';
                $query->orderBy('imdb_rating', 'desc');
                break;

            case 'free':
                $title = 'Free Movies';
                $query->where('is_free', true);
                break;

            case 'genre':
                if ($genreId) {
                    $genre = Genre::findOrFail($genreId);
                    $title = $genre->name . ' Movies';
                    $query->whereHas('genres', function($q) use ($genreId) {
                        $q->where('genres.id', $genreId);
                    });
                }
                break;

            case 'actor':
                if ($actorId) {
                    $actor = Actor::findOrFail($actorId);
                    $title = 'Movies with ' . $actor->name;
                    $query->whereHas('actors', function($q) use ($actorId) {
                        $q->where('actors.id', $actorId);
                    });
                }
                break;

            default:
                // All movies, already set up
                break;
        }

        // Get the movies with pagination
        $movies = $query->paginate(20);

        // Get all genres for the filter sidebar
        $genres = Genre::orderBy('name')->get();

        return view('frontend.filter.index', compact('movies', 'genres', 'title', 'section', 'genreId', 'actorId'));
    }

    public function watchlist()
    {
        $watchlists =  Watchlist::all();
        $movies = Movie::all();
        $playlists = Playlist::all();
        return view('frontend.watchlist.index', compact('watchlists', 'movies', 'playlists'));
    }

    public function playlistDetail($id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('frontend.watchlist.playlist_detail', compact('playlist'));
    }

    public function playlistStore(Request $request)
    {
        $userId = auth()->id();
        $movieId = $request->movie_id;
        $playlistIds = $request->playlists;

        foreach ($playlistIds as $playlistId) {
            $exists = DB::table('movie_playlist')
                ->where('movie_id', $movieId)
                ->where('playlist_id', $playlistId)
                ->exists();

            if (!$exists) {
                DB::table('movie_playlist')->insert([
                    'movie_id' => $movieId,
                    'playlist_id' => $playlistId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return back()->with('success', 'Movie added to playlist successfully!');
    }


    public function subscription()
    {
        // Fetch the subscription plans
        $plans = SubscriptionPlan::active()->get(); // Fetch active plans

        return view('frontend.subscription.index', compact('plans'));
    }

    public function login()
    {
        return redirect()->route('login');
    }

    public function register()
    {
        return redirect()->route('register');
    }

    public function restrictDetail()
    {
        return view('frontend.detail.restrict_detail');
    }

    public function genre()
    {
        $genres = Genre::all();
        return view('frontend.genre.index', compact('genres'));
    }

    public function actor()
    {
        return view('frontend.actor.index');
    }

    public function actorDetail($id = null)
    {
        $actor = null;
        if ($id) {
            $actor = Actor::findOrFail($id);
        }
        return view('frontend.actor.actor-detail', compact('actor'));
    }

    /**
     * Search for movies by title
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $title = 'Search Results for "' . $query . '"';
        $section = 'search';

        // Search for movies that match the query in their title
        $movies = Movie::where('status', 'active')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->paginate(20);

        // Get all genres for the filter sidebar
        $genres = Genre::orderBy('name')->get();

        return view('frontend.filter.index', compact('movies', 'genres', 'title', 'section', 'query'));
    }

    public function error404()
    {
        return view('frontend.404.index');
    }

    public function movie()
    {
        return view('frontend.movie.index');
    }

    public function tvSerie()
    {
        return view('frontend.tv-serie.index');
    }

    public function cart()
    {
        return view('frontend.cart.index');
    }

    public function checkout()
    {
        return view('frontend.cart.checkout');
    }

    public function orderDetail()
    {
        return view('frontend.cart.order-detail');
    }

    /**
     * Display the user's account page.
     */
    public function account()
    {
        $user = Auth::user();

        // Get user's orders
        $orders = Order::where('user_id', $user->id)
            ->with(['items.movie', 'paymentDetail.payment'])
            ->latest()
            ->get();

        // Get user's active subscription
        $activeSubscription = Subscription::with('plan')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        // Get user's subscription history
        $subscriptions = Subscription::with('plan')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('frontend.account.index', compact(
            'user',
            'orders',
            'activeSubscription',
            'subscriptions'
        ));
    }
}

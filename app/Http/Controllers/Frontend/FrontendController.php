<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Favorite;
use App\Models\Playlist;
use App\Models\watchlist;
use App\Models\SubscriptionPlan;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Director;


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
        $userId = Auth::id();
        $playlists = Playlist::where('user_id', $userId)->get();
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
        $canWatchMovie = true; // Default to true
        $restrictionMessage = null;
        $relatedMovies = collect(); // Initialize empty collection for related movies

        if ($id) {
            $movie = Movie::with(['actors', 'directors', 'genres'])->findOrFail($id);

            // Fetch related movies based on genres
            if ($movie->genres->isNotEmpty()) {
                $genreIds = $movie->genres->pluck('id')->toArray();

                $relatedMovies = Movie::where('id', '!=', $movie->id) // Exclude current movie
                    ->where('status', 'active')
                    ->whereHas('genres', function($query) use ($genreIds) {
                        $query->whereIn('genres.id', $genreIds);
                    })
                    ->take(10)
                    ->get();

                // If we don't have enough related movies by genre, add some based on actors
                if ($relatedMovies->count() < 5 && $movie->actors->isNotEmpty()) {
                    $actorIds = $movie->actors->pluck('id')->toArray();

                    $actorRelatedMovies = Movie::where('id', '!=', $movie->id)
                        ->where('status', 'active')
                        ->whereHas('actors', function($query) use ($actorIds) {
                            $query->whereIn('actors.id', $actorIds);
                        })
                        ->whereNotIn('id', $relatedMovies->pluck('id')->toArray()) // Exclude already added movies
                        ->take(10 - $relatedMovies->count())
                        ->get();

                    $relatedMovies = $relatedMovies->concat($actorRelatedMovies);
                }
            }

            // If still not enough related movies, add some recent ones from the same type (movie/series)
            if ($relatedMovies->count() < 5) {
                $typeRelatedMovies = Movie::where('id', '!=', $movie->id)
                    ->where('status', 'active')
                    ->where('type', $movie->type)
                    ->whereNotIn('id', $relatedMovies->pluck('id')->toArray())
                    ->orderBy('release_date', 'desc')
                    ->take(10 - $relatedMovies->count())
                    ->get();

                $relatedMovies = $relatedMovies->concat($typeRelatedMovies);
            }

            // If movie is free, anyone can watch it
            if ($movie->is_free) {
                $canWatchMovie = true;
            }
            // If user is not logged in and movie is not free
            elseif (!Auth::check()) {
                $canWatchMovie = false;
                $restrictionMessage = 'Please log in to access this content.';
            }
            // If user is logged in but movie is not free
            else {
                $user = Auth::user();

                // Check if user has purchased this movie individually
                $hasPurchasedMovie = Order::where('user_id', $user->id)
                    ->where('status', 'completed')
                    ->whereHas('items', function ($query) use ($movie) {
                        $query->where('movie_id', $movie->id);
                    })
                    ->exists();

                // If user has purchased this movie, they can watch it
                if ($hasPurchasedMovie) {
                    $canWatchMovie = true;
                }
                // Otherwise, check if they have a valid subscription
                else {
                    // Get active subscription with completed payment
                    $hasValidSubscription = Subscription::where('user_id', $user->id)
                        ->where('status', 'active')
                        ->where('end_date', '>', now())
                        ->whereHas('payments', function($query) {
                            $query->where('status', 'completed');
                        })
                        ->exists();

                    // Set access based on subscription status
                    if ($hasValidSubscription) {
                        $canWatchMovie = true;
                    } else {
                        $canWatchMovie = false;
                        $restrictionMessage = 'You need an active subscription with completed payment to access this content.';
                    }
                }
            }
        }

        return view('frontend.detail.index', compact(
            'movie',
            'recommendedMovies',
            'popularMovies',
            'playlists',
            'canWatchMovie',
            'restrictionMessage',
            'relatedMovies'
        ));
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
        $userId = Auth::id();

        $watchlists = Watchlist::where('user_id', $userId)->get();
        $playlists = Playlist::where('user_id', $userId)->get();
        $favorites = Favorite::where('user_id', $userId)->get();

        return view('frontend.watchlist.index', compact('watchlists', 'playlists', 'favorites'));
    }

    public function playlistDetail($id)
    {
        $userId = Auth::id();
        $playlists = Playlist::where('user_id', $userId)->get();
        return view('frontend.watchlist.playlist_detail', compact('playlist'));
    }

    public function playlistStore(Request $request)
    {
        $userId = Auth::id();
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
        $message = session('error') ?? 'You do not have access to this content.';
        return view('frontend.detail.restrict_detail', compact('message'));
    }

    public function genre()
    {
        $genres = Genre::all();
        return view('frontend.genre.index', compact('genres'));
    }

    public function director()
    {
        $directors = Director::orderBy('name')->paginate(30);

        if(request()->ajax() || request()->has('ajax')) {
            // Small delay to make loading indicator visible
            usleep(300000); // 300ms delay

            // If no items on this page or beyond last page, return empty
            if ($directors->count() === 0 || $directors->currentPage() > $directors->lastPage()) {
                return response()->json([
                    'status' => 'empty',
                    'message' => 'No more directors to load',
                    'page' => request()->get('page', 1),
                    'total_pages' => $directors->lastPage()
                ]);
            }

            // Get the rendered HTML for the items
            $html = view('frontend.actor.partials.items', compact('directors'))->render();

            // For debugging, if the test parameter is set
            if (request()->has('test')) {
                return response($html)->header('Content-Type', 'text/html');
            }

            // Return the HTML as a regular response
            return response($html)->header('Content-Type', 'text/html');
        }

        return view('frontend.actor.index', compact('directors'));
    }

    public function actor()
    {
        $actors = Actor::orderBy('name')->paginate(30);

        if(request()->ajax() || request()->has('ajax')) {
            // Small delay to make loading indicator visible
            usleep(300000); // 300ms delay

            // If no items on this page or beyond last page, return empty
            if ($actors->count() === 0 || $actors->currentPage() > $actors->lastPage()) {
                return response()->json([
                    'status' => 'empty',
                    'message' => 'No more actors to load',
                    'page' => request()->get('page', 1),
                    'total_pages' => $actors->lastPage()
                ]);
            }

            // Get the rendered HTML for the items
            $html = view('frontend.actor.partials.items', compact('actors'))->render();

            // For debugging, if the test parameter is set
            if (request()->has('test')) {
                return response($html)->header('Content-Type', 'text/html');
            }

            // Return the HTML as a regular response
            return response($html)->header('Content-Type', 'text/html');
        }

        return view('frontend.actor.index', compact('actors'));
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
     * Display the director detail page
     */
    public function directorDetail($id = null)
    {
        $director = null;
        if ($id) {
            $director = Director::findOrFail($id);
        }

        // Get movies directed by this director
        $movies = [];
        if ($director) {
            $movies = $director->movies()->get();
        }

        // Use actors variable name to reuse the favourite-person-block view
        $actors = collect([$director]);

        return view('frontend.actor.actor-detail', compact('director', 'actors', 'movies'));
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

    /**
     * Display the demo page for actors with infinite scroll
     */
    public function actorDemo()
    {
        $actors = Actor::orderBy('name')->paginate(10); // Use smaller pagination for the demo

        if(request()->ajax() || request()->has('ajax')) {
            // If no items on this page or beyond last page, return empty
            if ($actors->count() === 0 || $actors->currentPage() > $actors->lastPage()) {
                return response()->json([
                    'status' => 'empty',
                    'message' => 'No more actors to load',
                    'page' => request()->get('page', 1),
                    'total_pages' => $actors->lastPage()
                ]);
            }

            // Return just the actor items HTML
            return view('frontend.actor.partials.demo-items', compact('actors'))->render();
        }

        return view('frontend.actor.demo', compact('actors'));
    }

    /**
     * Display the demo page for directors with infinite scroll
     */
    public function directorDemo()
    {
        $directors = Director::orderBy('name')->paginate(10); // Use smaller pagination for the demo

        if(request()->ajax() || request()->has('ajax')) {
            // If no items on this page or beyond last page, return empty
            if ($directors->count() === 0 || $directors->currentPage() > $directors->lastPage()) {
                return response()->json([
                    'status' => 'empty',
                    'message' => 'No more directors to load',
                    'page' => request()->get('page', 1),
                    'total_pages' => $directors->lastPage()
                ]);
            }

            // Return just the director items HTML
            return view('frontend.actor.partials.demo-items', compact('directors'))->render();
        }

        return view('frontend.actor.demo', compact('directors'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Actor;

class FrontendController extends Controller
{
    public function index()
    {
        $recommendedMovies = Movie::where('status', 'active')
            ->where(function($query) {
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
        $recommendedMovies = Movie::where('status', 'active')
            ->where(function($query) {
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

        return view('frontend.detail.index', compact('movie', 'recommendedMovies', 'popularMovies'));
    }

    public function watchlist()
    {
        return view('frontend.watchlist.index');
    }


    public function subscription()
    {
        return view('frontend.subscription.index');
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
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.home.index');
    }

    public function detail()
    {
        return view('frontend.detail.index');
    }

    public function watchlist()
    {
        return view('frontend.watchlist.index');
    }

    public function account()
    {
        return view('frontend.account.index');
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
        return view('frontend.genre.index');
    }

    public function actor()
    {
        return view('frontend.actor.index');
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

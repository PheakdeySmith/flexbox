<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home.index');
    }

    public function detail()
    {
        return view('frontend.home.detail');
    }

    public function movie()
    {
        return view('frontend.home.movie');
    }

    public function tv_serie()
    {
        return view('frontend.home.tv_series');
    }
}

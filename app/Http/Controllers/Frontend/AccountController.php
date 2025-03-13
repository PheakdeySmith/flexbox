<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::with(['items.movie', 'paymentDetail.payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.account.index', compact('user', 'orders'));
    }
}

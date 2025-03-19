<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Watchlist;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        // Get counts for dashboard
        $totalMovies = Movie::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        // Get recent orders
        $recentOrders = Order::with('user')
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get top movies by revenue
        $topMoviesByRevenue = Movie::select('movies.id', 'movies.title', DB::raw('SUM(order_items.price) as revenue'), DB::raw('COUNT(order_items.id) as purchase_count'))
            ->join('order_items', 'movies.id', '=', 'order_items.movie_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->groupBy('movies.id', 'movies.title')
            ->orderBy('revenue', 'desc')
            ->limit(5)
            ->get();

        return view('backend.reports.index', compact(
            'totalMovies',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'topMoviesByRevenue'
        ));
    }

    /**
     * Display the movie revenue report.
     */
    public function movieRevenue(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get movie revenue data
        $movieRevenueData = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                'movies.price',
                DB::raw('COUNT(DISTINCT order_items.id) as purchase_count'),
                DB::raw('SUM(IFNULL(order_items.price, 0)) as revenue')
            )
            ->leftJoin('order_items', 'movies.id', '=', 'order_items.movie_id')
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed')
                    ->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date', 'movies.price')
            ->orderBy('revenue', 'desc')
            ->paginate(10);

        // Get all movie revenue data for chart
        $allMovieRevenueData = Movie::select(
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(IFNULL(order_items.price, 0)) as revenue')
            )
            ->leftJoin('order_items', 'movies.id', '=', 'order_items.movie_id')
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed')
                    ->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $allMovieRevenueData->pluck('date')->toJson();
        $chartData = $allMovieRevenueData->pluck('revenue')->toJson();

        // Calculate totals
        $totalRevenue = $movieRevenueData->sum('revenue');
        $totalPurchases = $movieRevenueData->sum('purchase_count');

        return view('backend.reports.movie-revenue', compact(
            'movieRevenueData',
            'startDate',
            'endDate',
            'totalRevenue',
            'totalPurchases',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Display the subscription analytics report.
     */
    public function subscriptionAnalytics(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get subscription plan data
        $subscriptionPlans = SubscriptionPlan::select(
                'subscription_plans.id',
                'subscription_plans.name',
                'subscription_plans.price',
                'subscription_plans.duration_in_days as duration',
                DB::raw('COUNT(CASE WHEN subscriptions.status = "active" THEN subscriptions.id END) as active_count'),
                DB::raw('COUNT(CASE WHEN subscriptions.status = "canceled" THEN subscriptions.id END) as canceled_count'),
                DB::raw('SUM(CASE WHEN payments.status = "completed" THEN payments.amount ELSE 0 END) as revenue')
            )
            ->leftJoin('subscriptions', function($join) use ($startDate, $endDate) {
                $join->on('subscription_plans.id', '=', 'subscriptions.subscription_plan_id')
                    ->whereBetween('subscriptions.created_at', [$startDate, $endDate]);
            })
            ->leftJoin('payments', 'subscriptions.id', '=', 'payments.subscription_id')
            ->groupBy('subscription_plans.id', 'subscription_plans.name', 'subscription_plans.price', 'subscription_plans.duration_in_days')
            ->get();

        // Get monthly subscription data for chart
        $monthlySubscriptions = Subscription::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('created_at', [$startDate->copy()->startOfMonth(), $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $chartLabels = $monthlySubscriptions->map(function($item) {
            return Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
        })->toJson();

        $chartData = $monthlySubscriptions->pluck('total')->toJson();

        // Calculate totals
        $totalActiveSubscriptions = $subscriptionPlans->sum('active_count');
        $totalCanceledSubscriptions = $subscriptionPlans->sum('canceled_count');
        $totalSubscriptionRevenue = $subscriptionPlans->sum('revenue');

        return view('backend.reports.subscription-analytics', compact(
            'subscriptionPlans',
            'startDate',
            'endDate',
            'totalActiveSubscriptions',
            'totalCanceledSubscriptions',
            'totalSubscriptionRevenue',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Display the user activity report.
     */
    public function userActivity(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        $startDate = $startDate->startOfDay();
        $endDate = $endDate->endOfDay();

        // Get user activity data
        $users = User::select(
                'users.id',
                'users.name',
                'users.email',
                'users.user_profile',
                'users.created_at',
                DB::raw('COUNT(DISTINCT watchlists.id) as watchlist_count'),
                DB::raw('COUNT(DISTINCT favorites.id) as favorite_count'),
                DB::raw('COUNT(DISTINCT orders.id) as purchase_count'),
                DB::raw('COUNT(DISTINCT reviews.id) as review_count')
            )
            ->leftJoin('watchlists', function($join) use ($startDate, $endDate) {
                $join->on('users.id', '=', 'watchlists.user_id')
                    ->whereBetween('watchlists.created_at', [$startDate, $endDate]);
            })
            ->leftJoin('favorites', function($join) use ($startDate, $endDate) {
                $join->on('users.id', '=', 'favorites.user_id')
                    ->whereBetween('favorites.created_at', [$startDate, $endDate]);
            })
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('users.id', '=', 'orders.user_id')
                    ->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->leftJoin('reviews', function($join) use ($startDate, $endDate) {
                $join->on('users.id', '=', 'reviews.user_id')
                    ->whereBetween('reviews.created_at', [$startDate, $endDate]);
            })
            ->groupBy('users.id', 'users.name', 'users.email', 'users.user_profile', 'users.created_at')
            ->orderBy('watchlist_count', 'desc')
            ->paginate(10);

        // Calculate totals
        $totalWatchlistAdds = $users->sum('watchlist_count');
        $totalFavorites = $users->sum('favorite_count');
        $totalPurchases = $users->sum('purchase_count');
        $totalReviews = $users->sum('review_count');

        // Count active users (users with any activity)
        $activeUsers = User::where(function($query) use ($startDate, $endDate) {
                $query->whereHas('watchlists', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->orWhereHas('favorites', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->orWhereHas('orders', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->orWhereHas('reviews', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                });
            })
            ->count();

        return view('backend.reports.user-activity', compact(
            'users',
            'startDate',
            'endDate',
            'totalWatchlistAdds',
            'totalFavorites',
            'totalPurchases',
            'totalReviews',
            'activeUsers'
        ));
    }

    /**
     * Display the content performance report.
     */
    public function contentPerformance(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get top rated movies
        $topRatedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('AVG(IFNULL(reviews.rating, 0)) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->leftJoin('reviews', function($join) use ($startDate, $endDate) {
                $join->on('movies.id', '=', 'reviews.movie_id')
                    ->whereBetween('reviews.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->having('review_count', '>', 0)
            ->orderBy('avg_rating', 'desc')
            ->limit(10)
            ->get();

        // Get most watched movies (from watchlists)
        $mostWatchedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('COUNT(watchlists.id) as watchlist_count')
            )
            ->leftJoin('watchlists', function($join) use ($startDate, $endDate) {
                $join->on('movies.id', '=', 'watchlists.movie_id')
                    ->whereBetween('watchlists.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->orderBy('watchlist_count', 'desc')
            ->limit(10)
            ->get();

        // Get most favorited movies
        $mostFavoritedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('COUNT(favorites.id) as favorite_count')
            )
            ->leftJoin('favorites', function($join) use ($startDate, $endDate) {
                $join->on('movies.id', '=', 'favorites.movie_id')
                    ->whereBetween('favorites.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->orderBy('favorite_count', 'desc')
            ->limit(10)
            ->get();

        // Get most purchased movies
        $mostPurchasedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('COUNT(order_items.id) as purchase_count'),
                DB::raw('SUM(IFNULL(order_items.price, 0)) as revenue')
            )
            ->leftJoin('order_items', 'movies.id', '=', 'order_items.movie_id')
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed')
                    ->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->orderBy('purchase_count', 'desc')
            ->limit(10)
            ->get();

        return view('backend.reports.content-performance', compact(
            'topRatedMovies',
            'mostWatchedMovies',
            'mostFavoritedMovies',
            'mostPurchasedMovies',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Print the movie revenue report.
     */
    public function printMovieRevenue(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Get movie revenue data without pagination
        $movieRevenueData = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                'movies.price',
                DB::raw('COUNT(DISTINCT order_items.id) as purchase_count'),
                DB::raw('SUM(IFNULL(order_items.price, 0)) as revenue')
            )
            ->leftJoin('order_items', 'movies.id', '=', 'order_items.movie_id')
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed')
                    ->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date', 'movies.price')
            ->orderBy('revenue', 'desc')
            ->get();

        // Calculate totals
        $totalRevenue = $movieRevenueData->sum('revenue');
        $totalPurchases = $movieRevenueData->sum('purchase_count');

        return view('backend.reports.print.movie-revenue', compact(
            'movieRevenueData',
            'startDate',
            'endDate',
            'totalRevenue',
            'totalPurchases'
        ));
    }

    /**
     * Print the subscription analytics report.
     */
    public function printSubscriptionAnalytics(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get all subscription plan data
        $subscriptionPlans = SubscriptionPlan::select(
                'subscription_plans.id',
                'subscription_plans.name',
                'subscription_plans.price',
                'subscription_plans.duration_in_days as duration',
                DB::raw('COUNT(CASE WHEN subscriptions.status = "active" THEN subscriptions.id END) as active_count'),
                DB::raw('COUNT(CASE WHEN subscriptions.status = "canceled" THEN subscriptions.id END) as canceled_count'),
                DB::raw('SUM(CASE WHEN payments.status = "completed" THEN payments.amount ELSE 0 END) as revenue')
            )
            ->leftJoin('subscriptions', function($join) use ($startDate, $endDate) {
                $join->on('subscription_plans.id', '=', 'subscriptions.subscription_plan_id')
                    ->whereBetween('subscriptions.created_at', [$startDate, $endDate]);
            })
            ->leftJoin('payments', 'subscriptions.id', '=', 'payments.subscription_id')
            ->groupBy('subscription_plans.id', 'subscription_plans.name', 'subscription_plans.price', 'subscription_plans.duration_in_days')
            ->get();

        // Calculate totals
        $totalActiveSubscriptions = $subscriptionPlans->sum('active_count');
        $totalCanceledSubscriptions = $subscriptionPlans->sum('canceled_count');
        $totalSubscriptionRevenue = $subscriptionPlans->sum('revenue');

        return view('backend.reports.print.subscription-analytics', compact(
            'subscriptionPlans',
            'startDate',
            'endDate',
            'totalActiveSubscriptions',
            'totalCanceledSubscriptions',
            'totalSubscriptionRevenue'
        ));
    }

    /**
     * Print the user activity report.
     */
    public function printUserActivity(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get all user activity data without pagination
        $users = User::select(
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                DB::raw('COUNT(DISTINCT watchlists.id) as watchlist_count'),
                DB::raw('COUNT(DISTINCT favorites.id) as favorite_count'),
                DB::raw('COUNT(DISTINCT reviews.id) as review_count'),
                DB::raw('COUNT(DISTINCT orders.id) as order_count'),
                DB::raw('SUM(CASE WHEN orders.status = "completed" THEN orders.total_amount ELSE 0 END) as total_spent')
            )
            ->leftJoin('watchlists', 'users.id', '=', 'watchlists.user_id')
            ->leftJoin('favorites', 'users.id', '=', 'favorites.user_id')
            ->leftJoin('reviews', 'users.id', '=', 'reviews.user_id')
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->whereBetween('users.created_at', [$startDate, $endDate])
            ->groupBy('users.id', 'users.name', 'users.email', 'users.created_at')
            ->orderBy('total_spent', 'desc')
            ->get();

        // Calculate totals
        $totalNewUsers = User::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalWatchlistItems = Watchlist::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalFavorites = Favorite::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalReviews = Review::whereBetween('created_at', [$startDate, $endDate])->count();

        return view('backend.reports.print.user-activity', compact(
            'users',
            'startDate',
            'endDate',
            'totalNewUsers',
            'totalWatchlistItems',
            'totalFavorites',
            'totalReviews'
        ));
    }

    /**
     * Print the content performance report.
     */
    public function printContentPerformance(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        // Get all performance data
        $topRatedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('AVG(IFNULL(reviews.rating, 0)) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->leftJoin('reviews', function($join) use ($startDate, $endDate) {
                $join->on('movies.id', '=', 'reviews.movie_id')
                    ->whereBetween('reviews.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->having('review_count', '>', 0)
            ->orderBy('avg_rating', 'desc')
            ->get();

        $mostWatchedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('COUNT(watchlists.id) as watchlist_count')
            )
            ->leftJoin('watchlists', function($join) use ($startDate, $endDate) {
                $join->on('movies.id', '=', 'watchlists.movie_id')
                    ->whereBetween('watchlists.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->orderBy('watchlist_count', 'desc')
            ->get();

        $mostFavoritedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('COUNT(favorites.id) as favorite_count')
            )
            ->leftJoin('favorites', function($join) use ($startDate, $endDate) {
                $join->on('movies.id', '=', 'favorites.movie_id')
                    ->whereBetween('favorites.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->orderBy('favorite_count', 'desc')
            ->get();

        $mostPurchasedMovies = Movie::select(
                'movies.id',
                'movies.title',
                'movies.poster_url as poster_path',
                'movies.release_date',
                DB::raw('COUNT(order_items.id) as purchase_count'),
                DB::raw('SUM(IFNULL(order_items.price, 0)) as revenue')
            )
            ->leftJoin('order_items', 'movies.id', '=', 'order_items.movie_id')
            ->leftJoin('orders', function($join) use ($startDate, $endDate) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed')
                    ->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->groupBy('movies.id', 'movies.title', 'movies.poster_url', 'movies.release_date')
            ->orderBy('purchase_count', 'desc')
            ->get();

        return view('backend.reports.print.content-performance', compact(
            'topRatedMovies',
            'mostWatchedMovies',
            'mostFavoritedMovies',
            'mostPurchasedMovies',
            'startDate',
            'endDate'
        ));
    }
}

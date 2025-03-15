<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\Review;
use App\Models\Genre;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Playlist;
use App\Models\Watchlist;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page with statistics and charts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Get counts for main stats with default values for empty DB
            $totalUsers = User::count() ?: 0;
            $totalMovies = Movie::count() ?: 0;
            $totalRevenue = Payment::sum('amount') ?: 0;
            $activeSubscriptions = Subscription::where('status', 'active')->count() ?: 0;

            // Get latest users
            $recentUsers = User::latest()->take(8)->get();

            // Get latest orders
            $recentOrders = Order::with('user')
                ->latest()
                ->take(5)
                ->get();

            // Ensure all orders have an amount value
            $recentOrders->each(function ($order) {
                if (!isset($order->amount)) {
                    $order->amount = 0;
                }
            });

            // Get most popular movies (by reviews)
            $popularMovies = Movie::withCount('reviews')
                ->orderBy('reviews_count', 'desc')
                ->take(5)
                ->get();

            // Get genre distribution
            $genreDistribution = Genre::withCount('movies')
                ->orderBy('movies_count', 'desc')
                ->take(10)
                ->get();

            // Calculate monthly revenue for the last 6 months
            $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();
            $monthlyRevenue = $this->getMonthlyData(Payment::class, 'amount', $sixMonthsAgo);

            // Get monthly new subscribers for the last 6 months
            $monthlySubscribers = $this->getMonthlySubscriberCounts($sixMonthsAgo);

            // Get plan distribution
            $planDistribution = $this->getSubscriptionPlanDistribution();

            // Get latest reviews
            $recentReviews = Review::with(['user', 'movie'])
                ->latest()
                ->take(5)
                ->get();

            return view('backend.dashbaord.index', compact(
                'totalUsers',
                'totalMovies',
                'totalRevenue',
                'activeSubscriptions',
                'recentUsers',
                'recentOrders',
                'popularMovies',
                'genreDistribution',
                'monthlyRevenue',
                'monthlySubscribers',
                'planDistribution',
                'recentReviews'
            ));
        } catch (Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());

            // Return view with empty data
            return view('backend.dashbaord.index', [
                'totalUsers' => 0,
                'totalMovies' => 0,
                'totalRevenue' => 0,
                'activeSubscriptions' => 0,
                'recentUsers' => collect(),
                'recentOrders' => collect(),
                'popularMovies' => collect(),
                'genreDistribution' => collect(),
                'monthlyRevenue' => [],
                'monthlySubscribers' => [],
                'planDistribution' => [],
                'recentReviews' => collect(),
            ]);
        }
    }

    /**
     * Get monthly data for a given model with sum or count
     *
     * @param string $model
     * @param string|null $sumField
     * @param Carbon $startDate
     * @return array
     */
    private function getMonthlyData($model, $sumField = null, Carbon $startDate)
    {
        try {
            $query = $model::query()
                ->where('created_at', '>=', $startDate);

            if ($sumField) {
                $query->select(
                    DB::raw("SUM($sumField) as total"),
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
                );
            } else {
                $query->select(
                    DB::raw("COUNT(*) as total"),
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
                );
            }

            $results = $query->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            // Fill in missing months with zeros for continuity
            $months = [];
            $currentDate = clone $startDate;
            $endDate = Carbon::now()->endOfMonth();

            while ($currentDate->lte($endDate)) {
                $key = $currentDate->format('Y-m');
                $months[$key] = isset($results[$key]) ? $results[$key] : 0;
                $currentDate->addMonth();
            }

            return $months;
        } catch (Exception $e) {
            Log::error('Error generating monthly data: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get monthly subscriber counts
     *
     * @param Carbon $startDate
     * @return array
     */
    private function getMonthlySubscriberCounts(Carbon $startDate)
    {
        return $this->getMonthlyData(Subscription::class, null, $startDate);
    }

    /**
     * Get subscription plan distribution
     *
     * @return array
     */
    private function getSubscriptionPlanDistribution()
    {
        try {
            $plans = SubscriptionPlan::withCount('subscriptions')->get();

            if ($plans->isEmpty()) {
                // If no plans exist, return placeholder data
                return ['No Plans' => 1];
            }

            return $plans->pluck('subscriptions_count', 'name')->toArray();
        } catch (Exception $e) {
            Log::error('Error getting subscription plan distribution: ' . $e->getMessage());
            return ['Error' => 1];
        }
    }
}

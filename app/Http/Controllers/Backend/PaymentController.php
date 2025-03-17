<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $type = $request->input('type');
        $query = Payment::with(['user', 'detail.payable']);

        if ($status) {
            $query->withStatus($status);
        }

        // Check if payment_type column exists
        $hasPaymentTypeColumn = Schema::hasColumn('payments', 'payment_type');

        if ($type && $hasPaymentTypeColumn) {
            if ($type === 'subscription') {
                $query->subscriptions();
            } elseif ($type === 'movie_purchase') {
                $query->moviePurchases();
            }
        } elseif ($type) {
            // Fallback if payment_type column doesn't exist
            if ($type === 'subscription') {
                $query->whereNotNull('subscription_id');
            } elseif ($type === 'movie_purchase') {
                $query->whereNull('subscription_id');
            }
        }

        // Get all necessary data with a single query to improve performance
        $payments = $query->latest()->paginate(10);

        // We need the counts of payments by status for the stat boxes
        $paymentCounts = Payment::select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->pluck('count', 'status')
                        ->toArray();

        // Get total revenue from completed payments
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');

        // Calculate current month's revenue
        $currentMonthRevenue = Payment::where('status', 'completed')
                              ->whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->sum('amount');

        // Calculate previous month's revenue
        $previousMonthRevenue = Payment::where('status', 'completed')
                               ->whereMonth('created_at', now()->subMonth()->month)
                               ->whereYear('created_at', now()->subMonth()->year)
                               ->sum('amount');

        // Calculate revenue growth percentage
        $revenueGrowth = 0;
        if ($previousMonthRevenue > 0) {
            $revenueGrowth = (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100;
        }

        return view('backend.payments.index', compact(
            'payments',
            'paymentCounts',
            'totalRevenue',
            'currentMonthRevenue',
            'previousMonthRevenue',
            'revenueGrowth'
        ));
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'detail.payable']);

        return view('backend.payments.show', compact('payment'));
    }

    /**
     * Update the status of the specified payment.
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
        ]);

        DB::beginTransaction();

        try {
            $payment->update([
                'status' => $request->status,
            ]);

            // Update the related entity status
            if ($payment->detail && $payment->detail->payable) {
                $payable = $payment->detail->payable;

                if ($payable instanceof \App\Models\Order) {
                    $orderStatus = $request->status === 'completed' ? 'completed' :
                                  ($request->status === 'refunded' ? 'cancelled' : 'pending');

                    $payable->update([
                        'status' => $orderStatus,
                    ]);

                    // Update order items status
                    $payable->items()->update([
                        'status' => $orderStatus,
                    ]);
                } elseif ($payable instanceof \App\Models\Subscription) {
                    $subscriptionStatus = $request->status === 'completed' ? 'active' :
                                         ($request->status === 'refunded' ? 'canceled' : 'pending');

                    $payable->update([
                        'status' => $subscriptionStatus,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('payment.show', $payment)
                ->with('success', 'Payment status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('payment.show', $payment)
                ->with('error', 'Failed to update payment status: ' . $e->getMessage());
        }
    }

    /**
     * Display a dashboard with payment statistics.
     */
    public function dashboard(Request $request)
    {
        // Get date range from request or use defaults
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        $startDate = $startDate->startOfDay();
        $endDate = $endDate->endOfDay();

        // Calculate period duration
        $periodDuration = $startDate->diffInDays($endDate);

        // Define previous period date range
        $previousPeriodEnd = (clone $startDate)->subDay();
        $previousPeriodStart = (clone $previousPeriodEnd)->subDays($periodDuration);

        // Total revenue for current period
        $totalRevenue = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        // Current period revenue
        $currentPeriodRevenue = $totalRevenue;

        // Previous period revenue
        $previousPeriodRevenue = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])
            ->sum('amount');

        // Calculate revenue growth percentage
        $revenueGrowth = 0;
        if ($previousPeriodRevenue > 0) {
            $revenueGrowth = (($currentPeriodRevenue - $previousPeriodRevenue) / $previousPeriodRevenue) * 100;
        }

        // Calculate user growth
        $currentPeriodUsers = User::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $previousPeriodUsers = User::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])
            ->count();

        $userGrowth = 0;
        if ($previousPeriodUsers > 0) {
            $userGrowth = (($currentPeriodUsers - $previousPeriodUsers) / $previousPeriodUsers) * 100;
        }

        // Calculate transaction growth
        $currentPeriodTransactions = Payment::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $previousPeriodTransactions = Payment::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])
            ->count();

        $transactionGrowth = 0;
        if ($previousPeriodTransactions > 0) {
            $transactionGrowth = (($currentPeriodTransactions - $previousPeriodTransactions) / $previousPeriodTransactions) * 100;
        }

        // Check if payment_type column exists
        $hasPaymentTypeColumn = Schema::hasColumn('payments', 'payment_type');

        // Subscription revenue
        if ($hasPaymentTypeColumn) {
            $subscriptionRevenue = Payment::subscriptions()
                ->where('status', 'completed')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');

            // Movie purchase revenue
            $moviePurchaseRevenue = Payment::moviePurchases()
                ->where('status', 'completed')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');
        } else {
            // Fallback if payment_type column doesn't exist
            $subscriptionRevenue = Payment::where('status', 'completed')
                ->whereNotNull('subscription_id')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');

            $moviePurchaseRevenue = Payment::where('status', 'completed')
                ->whereNull('subscription_id')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');
        }

        // Payment counts by status
        $paymentStatusCounts = Payment::select('status', DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Recent payments
        $recentPayments = Payment::with(['user', 'detail.payable'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->take(10)
            ->get();

        // Monthly revenue chart data for the last 12 months
        $monthlyRevenue = $this->getMonthlyRevenueData($startDate, $endDate);

        // Weekly revenue for the last 7 days
        $weeklyRevenue = $this->getWeeklyRevenueData($startDate, $endDate);

        // Payment method distribution
        $paymentMethods = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select('payment_method', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as amount'))
            ->groupBy('payment_method')
            ->orderBy('amount', 'desc')
            ->get();

        // Top paying users
        $topUsers = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select('user_id', DB::raw('SUM(amount) as total'))
            ->with('user:id,name,email,user_profile')
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('backend.payments.dashboard', compact(
            'totalRevenue',
            'currentPeriodRevenue',
            'previousPeriodRevenue',
            'revenueGrowth',
            'subscriptionRevenue',
            'moviePurchaseRevenue',
            'paymentStatusCounts',
            'recentPayments',
            'monthlyRevenue',
            'weeklyRevenue',
            'paymentMethods',
            'topUsers',
            'startDate',
            'endDate',
            'userGrowth',
            'transactionGrowth'
        ));
    }

    /**
     * Display payment history for a specific user.
     */
    public function userHistory(User $user)
    {
        $payments = Payment::with(['detail.payable'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        // Get total spent by user
        $totalSpent = Payment::where('user_id', $user->id)
                     ->where('status', 'completed')
                     ->sum('amount');

        // Get user's payment methods
        $userPaymentMethods = Payment::where('user_id', $user->id)
                            ->select('payment_method', DB::raw('COUNT(*) as count'))
                            ->groupBy('payment_method')
                            ->orderBy('count', 'desc')
                            ->get();

        return view('backend.payments.user-history', compact(
            'user',
            'payments',
            'totalSpent',
            'userPaymentMethods'
        ));
    }

    /**
     * Get monthly revenue data for the last 12 months
     */
    private function getMonthlyRevenueData($startDate, $endDate)
    {
        $data = [];

        // Determine the number of months to display based on date range
        $monthDiff = $startDate->diffInMonths($endDate) + 1;
        $monthsToShow = min($monthDiff, 12); // Limit to 12 months max

        // Initialize data array with zeros for all months in range
        $currentDate = clone $startDate;
        for ($i = 0; $i < $monthsToShow; $i++) {
            $yearMonth = $currentDate->format('Y-m');
            $monthName = $currentDate->format('M Y');
            $data[$yearMonth] = [
                'month' => $monthName,
                'total' => 0
            ];
            $currentDate->addMonth();
            if ($currentDate->gt($endDate)) {
                break;
            }
        }

        // Get actual revenue data
        $revenues = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('year', 'month')
            ->get();

        // Fill in actual data
        foreach ($revenues as $revenue) {
            $yearMonth = sprintf('%04d-%02d', $revenue->year, $revenue->month);
            if (isset($data[$yearMonth])) {
                $data[$yearMonth]['total'] = $revenue->total;
            }
        }

        return array_values($data);
    }

    /**
     * Get weekly revenue data for the last 7 days
     */
    private function getWeeklyRevenueData($startDate, $endDate)
    {
        $data = [];

        // Determine the number of days to display based on date range
        $dayDiff = $startDate->diffInDays($endDate) + 1;
        $daysToShow = min($dayDiff, 7); // Limit to 7 days max

        // If the date range is more than 7 days, use the most recent 7 days
        if ($dayDiff > 7) {
            $adjustedStartDate = (clone $endDate)->subDays(6);
            $currentDate = clone $adjustedStartDate;
        } else {
            $currentDate = clone $startDate;
        }

        // Initialize data array with zeros for all days in range
        for ($i = 0; $i < $daysToShow; $i++) {
            $dateKey = $currentDate->format('Y-m-d');
            $dayName = $currentDate->format('D, M d');
            $data[$dateKey] = [
                'day' => $dayName,
                'total' => 0
            ];
            $currentDate->addDay();
            if ($currentDate->gt($endDate)) {
                break;
            }
        }

        // Get actual revenue data
        $revenues = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take($daysToShow)
            ->get();

        // Fill in actual data
        foreach ($revenues as $revenue) {
            if (isset($data[$revenue->date])) {
                $data[$revenue->date]['total'] = (float)$revenue->total;
            }
        }

        // Sort by date (keys) to ensure chronological order
        ksort($data);

        return array_values($data);
    }
}

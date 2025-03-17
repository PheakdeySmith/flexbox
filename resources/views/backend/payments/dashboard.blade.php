@extends('backend.layouts.app')

@php
use Illuminate\Support\Facades\Schema;
@endphp

@section('styles')
<style>
    .growth-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        margin-bottom: 5px;
        color: white;
        font-weight: bold;
    }

    .growth-indicator.positive {
        background-color: #28a745;
    }

    .growth-indicator.negative {
        background-color: #dc3545;
    }

    .growth-value {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .knob-label {
        color: white;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Analytics Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">Payments</a></li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Revenue Overview -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Revenue Overview
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>{{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-white">
                                        <strong>Total Revenue: ${{ number_format($totalRevenue, 2) }}</strong>
                                        <span class="float-right">
                                            <i class="fas {{ $revenueGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                            {{ abs(round($revenueGrowth, 1)) }}%
                                        </span>
                                    </p>
                                    <div class="position-relative mb-4">
                                        <canvas id="revenue-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-white">
                                        <p class="text-center"><strong>Revenue Distribution</strong></p>
                                        <div class="progress-group">
                                            <span class="progress-text">Subscriptions</span>
                                            <span class="float-right">
                                                ${{ number_format($subscriptionRevenue ?? 0, 2) }}
                                                ({{ $totalRevenue > 0 ? round(($subscriptionRevenue ?? 0) / $totalRevenue * 100) : 0 }}%)
                                            </span>
                                            <div class="progress progress-sm bg-white">
                                                <div class="progress-bar bg-success" style="width: {{ $totalRevenue > 0 ? ($subscriptionRevenue ?? 0) / $totalRevenue * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <span class="progress-text">Movie Purchases</span>
                                            <span class="float-right">
                                                ${{ number_format($moviePurchaseRevenue ?? 0, 2) }}
                                                ({{ $totalRevenue > 0 ? round(($moviePurchaseRevenue ?? 0) / $totalRevenue * 100) : 0 }}%)
                                            </span>
                                            <div class="progress progress-sm bg-white">
                                                <div class="progress-bar bg-primary" style="width: {{ $totalRevenue > 0 ? ($moviePurchaseRevenue ?? 0) / $totalRevenue * 100 : 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="text-center mb-2">
                                                <h5 class="text-white">Monthly Growth</h5>
                                            </div>
                                            <div class="d-flex justify-content-around">
                                                <div class="text-center">
                                                    <div class="growth-indicator {{ $revenueGrowth >= 0 ? 'positive' : 'negative' }}">
                                                        <span class="growth-value">{{ abs(round($revenueGrowth)) }}%</span>
                                                        <i class="fas {{ $revenueGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                                    </div>
                                                    <div class="knob-label">Revenue</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="growth-indicator {{ $userGrowth >= 0 ? 'positive' : 'negative' }}">
                                                        <span class="growth-value">{{ abs(round($userGrowth)) }}%</span>
                                                        <i class="fas {{ $userGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                                    </div>
                                                    <div class="knob-label">Users</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="growth-indicator {{ $transactionGrowth >= 0 ? 'positive' : 'negative' }}">
                                                        <span class="growth-value">{{ abs(round($transactionGrowth)) }}%</span>
                                                        <i class="fas {{ $transactionGrowth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                                    </div>
                                                    <div class="knob-label">Transactions</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Stats Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- Total Payments -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ isset($paymentStatusCounts) ? array_sum($paymentStatusCounts) : $recentPayments->count() }}</h3>
                            <p>Total Payments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <a href="{{ route('payment.index') }}" class="small-box-footer">
                            All Payments <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- Completed Payments -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $paymentStatusCounts['completed'] ?? $recentPayments->where('status', 'completed')->count() }}</h3>
                            <p>Completed Payments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="{{ route('payment.index', ['status' => 'completed']) }}" class="small-box-footer">
                            View Completed <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- Pending Payments -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $paymentStatusCounts['pending'] ?? $recentPayments->where('status', 'pending')->count() }}</h3>
                            <p>Pending Payments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="{{ route('payment.index', ['status' => 'pending']) }}" class="small-box-footer">
                            View Pending <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- Failed Payments -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $paymentStatusCounts['failed'] ?? $recentPayments->where('status', 'failed')->count() }}</h3>
                            <p>Failed Payments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <a href="{{ route('payment.index', ['status' => 'failed']) }}" class="small-box-footer">
                            View Failed <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!-- Info Boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Current Period</span>
                            <span class="info-box-number">${{ number_format($currentPeriodRevenue ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Previous Period</span>
                            <span class="info-box-number">${{ number_format($previousPeriodRevenue ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Average Order</span>
                            <span class="info-box-number">
                                ${{ isset($paymentStatusCounts) && isset($paymentStatusCounts['completed']) && $paymentStatusCounts['completed'] > 0
                                    ? number_format($totalRevenue / $paymentStatusCounts['completed'], 2)
                                    : '0.00' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-credit-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Refunded</span>
                            <span class="info-box-number">{{ $paymentStatusCounts['refunded'] ?? $recentPayments->where('status', 'refunded')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row">
                <!-- Weekly Revenue Chart -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-week mr-1"></i>
                                Daily Revenue
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="daily-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Distribution -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-credit-card mr-1"></i>
                                Payment Methods
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-responsive">
                                <div class="chart" id="payment-methods-chart-container" style="height: 250px; width: 100%;">
                                    <canvas id="payment-methods-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Customers and Payment Status -->
            <div class="row">
                <!-- Top Paying Customers -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-trophy mr-1"></i>
                                Top Paying Customers
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Spending</th>
                                        <th>Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($topUsers ?? [] as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($user->user->profile_photo ?? 'AdminLTE/dist/img/user2-160x160.jpg') }}" alt="User Image" class="img-circle img-size-32 mr-2">
                                        {{ $user->user->name }}
                                        </td>
                                        <td>${{ number_format($user->total, 2) }}</td>
                                        <td>
                                            <small class="text-success mr-1">
                                                <i class="fas fa-shopping-cart"></i>
                                            </small>
                                            {{ $user->order_count ?? rand(1, 10) }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No customer data available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payment Status Distribution -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Payment Status Distribution
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-responsive">
                                <div class="chart" id="status-pie-chart-container" style="height: 250px; width: 100%;">
                                    <canvas id="status-pie-chart"></canvas>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="description-block border-right">
                                        <h5 class="description-header">{{ number_format($totalRevenue, 2) }}</h5>
                                        <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ isset($paymentStatusCounts) ? array_sum($paymentStatusCounts) : 0 }}</h5>
                                        <span class="description-text">TOTAL TRANSACTIONS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Recent Payments
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPayments as $payment)
                                <tr>
                                    <td><a href="{{ route('payment.show', $payment) }}">#{{ $payment->id }}</a></td>
                                    <td>
                                        <img src="{{ asset($payment->user->profile_photo ?? 'AdminLTE/dist/img/user2-160x160.jpg') }}" alt="{{ $payment->user->name }}" class="img-circle img-size-32 mr-2">
                                        {{ $payment->user->name }}
                                    </td>
                                    <td>
                                        @if (Schema::hasColumn('payments', 'payment_type'))
                                            @if ($payment->payment_type == 'subscription')
                                                <span class="badge bg-primary">Subscription</span>
                                            @elseif ($payment->payment_type == 'movie_purchase')
                                                <span class="badge bg-info">Movie Purchase</span>
                                            @endif
                                        @else
                                            @if ($payment->subscription_id)
                                                <span class="badge bg-primary">Subscription</span>
                                            @else
                                                <span class="badge bg-info">Movie Purchase</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>${{ number_format($payment->amount, 2) }}</td>
                                    <td>
                                        @if ($payment->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($payment->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif ($payment->status == 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @elseif ($payment->status == 'refunded')
                                            <span class="badge bg-info">Refunded</span>
                                        @endif
                                    </td>
                                    <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('payment.show', $payment) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No recent payments</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('payment.index') }}" class="btn btn-sm btn-primary float-right">
                        View All Payments
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- jQuery Knob -->
<script src="{{ asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<script>
$(function () {
    // Initialize knob charts
    $('.knob').knob({
        readOnly: true,
        fgColor: '#00c0ef',
        thickness: 0.1,
        width: 90,
        height: 90
    });

    // Monthly Revenue Chart
    var revenueChartCanvas = document.getElementById('revenue-chart').getContext('2d');

    // Extract month labels and revenue data from PHP
    var monthlyRevenueData = @json($monthlyRevenue ?? []);
    var months = [];
    var revenueData = [];

    // If we have actual data, use it
    if (Object.keys(monthlyRevenueData).length > 0) {
        for (var key in monthlyRevenueData) {
            months.push(monthlyRevenueData[key].month);
            revenueData.push(monthlyRevenueData[key].total);
        }
    } else {
        // Otherwise use dummy data
        months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        revenueData = [2000, 3000, 2500, 4000, 3500, 5000, 4500, 6000, 5500, 7000, 6500, {{ $currentMonthRevenue ?? 8000 }}];
    }

    var revenueChart = new Chart(revenueChartCanvas, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenue',
                backgroundColor: 'rgba(255, 255, 255, 0.3)',
                borderColor: '#ffffff',
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#ffffff',
                pointHoverBackgroundColor: '#ffffff',
                pointHoverBorderColor: '#ffffff',
                pointRadius: 4,
                fill: true,
                tension: 0.4,
                data: revenueData
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        return '$' + Number(tooltipItem.yLabel).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        color: 'rgba(255, 255, 255, 0.2)'
                    },
                    ticks: {
                        fontColor: '#ffffff'
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: true,
                        color: 'rgba(255, 255, 255, 0.2)'
                    },
                    ticks: {
                        fontColor: '#ffffff',
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    }
                }]
            }
        }
    });

    // Daily Revenue Chart
    var weeklyChartCanvas = document.getElementById('daily-chart').getContext('2d');

    // Extract day labels and revenue data from PHP
    var dailyRevenueData = @json($weeklyRevenue ?? []);
    var days = [];
    var weeklyData = [];

    // If we have actual data, use it
    if (dailyRevenueData && dailyRevenueData.length > 0) {
        for (var i = 0; i < dailyRevenueData.length; i++) {
            days.push(dailyRevenueData[i].day);
            weeklyData.push(parseFloat(dailyRevenueData[i].total));
        }
    } else {
        // Otherwise use dummy data
        days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        weeklyData = [500, 800, 600, 900, 700, 1200, 1000];
    }

    var weeklyChart = new Chart(weeklyChartCanvas, {
        type: 'bar',
        data: {
            labels: days,
            datasets: [{
                label: 'Daily Revenue',
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                pointRadius: false,
                data: weeklyData
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        return '$' + Number(tooltipItem.yLabel).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Day'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Revenue ($)'
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return '$' + value.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
                        }
                    }
                }]
            }
        }
    });

    // Payment Method Distribution
    var methodsChartCanvas = document.getElementById('payment-methods-chart').getContext('2d');

    // Extract payment method data
    var paymentMethods = @json($paymentMethods ?? []);
    var methodLabels = [];
    var methodData = [];
    var methodColors = ['#00c0ef', '#00a65a', '#f39c12', '#f56954', '#d2d6de'];

    // If we have actual data, use it
    if (paymentMethods.length > 0) {
        for (var i = 0; i < paymentMethods.length; i++) {
            methodLabels.push(paymentMethods[i].payment_method);
            methodData.push(paymentMethods[i].amount);
        }
    } else {
        // Otherwise use dummy data
        methodLabels = ['Credit Card', 'PayPal', 'Apple Pay', 'Google Pay', 'Other'];
        methodData = [5000, 3000, 2000, 1500, 1000];
    }

    var methodsChart = new Chart(methodsChartCanvas, {
        type: 'pie',
        data: {
            labels: methodLabels,
            datasets: [{
                data: methodData,
                backgroundColor: methodColors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                        return data.labels[tooltipItem.index] + ': $' +
                               currentValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +
                               ' (' + percentage + '%)';
                    }
                }
            }
        }
    });

    // Payment Status Distribution
    var statusChartCanvas = document.getElementById('status-pie-chart').getContext('2d');

    // Get status counts - fixing the JSON syntax issue
    @php
    $defaultStatusCounts = ['completed' => 1, 'pending' => 0, 'failed' => 0, 'refunded' => 0];
    @endphp
    var statusCounts = @json(isset($paymentStatusCounts) ? $paymentStatusCounts : $defaultStatusCounts);

    var statusChart = new Chart(statusChartCanvas, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Failed', 'Refunded'],
            datasets: [{
                data: [
                    statusCounts.completed || 0,
                    statusCounts.pending || 0,
                    statusCounts.failed || 0,
                    statusCounts.refunded || 0
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8'],
                borderColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                        return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                    }
                }
            }
        }
    });

    // Initialize date range picker
    $('.daterange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment("{{ $startDate->format('Y-m-d') }}"),
        endDate: moment("{{ $endDate->format('Y-m-d') }}")
    }, function (start, end) {
        // Refresh the data when date range changes
        window.location.href = '{{ route("payment.dashboard") }}?start_date=' + start.format('YYYY-MM-DD') + '&end_date=' + end.format('YYYY-MM-DD');
    });
});
</script>
@endsection


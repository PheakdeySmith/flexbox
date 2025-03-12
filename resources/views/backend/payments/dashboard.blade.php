@extends('backend.layouts.app')

@php
use Illuminate\Support\Facades\Schema;
@endphp

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container-fluid">
    <!-- Revenue Summary Cards -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Revenue</h5>
                            <h2 class="mb-0">${{ number_format($totalRevenue, 2) }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Subscription Revenue</h5>
                            <h2 class="mb-0">${{ number_format($subscriptionRevenue, 2) }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-calendar-alt fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Movie Purchase Revenue</h5>
                            <h2 class="mb-0">${{ number_format($moviePurchaseRevenue, 2) }}</h2>
                        </div>
                        <div>
                            <i class="fas fa-film fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Monthly Revenue Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly Revenue</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Payment Method Distribution -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Methods</h3>
                </div>
                <div class="card-body">
                    <canvas id="paymentMethodChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Payments</h3>
                    <div class="card-tools">
                        <a href="{{ route('payment.index') }}" class="btn btn-sm btn-primary">
                            View All Payments
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentPayments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->user->name }}</td>
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
                                <td>{{ ucfirst($payment->payment_method) }}</td>
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
                                <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('payment.show', $payment) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No recent payments found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Revenue Chart
        const monthlyData = @json($monthlyRevenue);
        const labels = monthlyData.map(item => {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            return monthNames[item.month - 1] + ' ' + item.year;
        });
        const values = monthlyData.map(item => item.total);

        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: values,
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor: 'rgba(60, 141, 188, 1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(60, 141, 188, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });

        // Payment Method Chart
        const methodData = @json($paymentMethods);
        const methodLabels = methodData.map(item => ucfirst(item.payment_method));
        const methodValues = methodData.map(item => item.count);
        const methodColors = [
            'rgba(60, 141, 188, 0.8)',
            'rgba(40, 167, 69, 0.8)',
            'rgba(255, 193, 7, 0.8)',
            'rgba(220, 53, 69, 0.8)',
            'rgba(23, 162, 184, 0.8)'
        ];

        const methodCtx = document.getElementById('paymentMethodChart').getContext('2d');
        new Chart(methodCtx, {
            type: 'doughnut',
            data: {
                labels: methodLabels,
                datasets: [{
                    data: methodValues,
                    backgroundColor: methodColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    });
</script>
@endpush

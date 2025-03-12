@extends('backend.layouts.app')

@php
use Illuminate\Support\Facades\Schema;
@endphp

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payments</h3>
                    <div class="card-tools">
                        <div class="btn-group mr-2">
                            <a href="{{ route('payment.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-default' }}">All</a>
                            <a href="{{ route('payment.index', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-primary' : 'btn-default' }}">Pending</a>
                            <a href="{{ route('payment.index', ['status' => 'completed']) }}" class="btn btn-sm {{ request('status') == 'completed' ? 'btn-primary' : 'btn-default' }}">Completed</a>
                            <a href="{{ route('payment.index', ['status' => 'failed']) }}" class="btn btn-sm {{ request('status') == 'failed' ? 'btn-primary' : 'btn-default' }}">Failed</a>
                            <a href="{{ route('payment.index', ['status' => 'refunded']) }}" class="btn btn-sm {{ request('status') == 'refunded' ? 'btn-primary' : 'btn-default' }}">Refunded</a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('payment.index') }}" class="btn btn-sm {{ !request('type') ? 'btn-primary' : 'btn-default' }}">All Types</a>
                            <a href="{{ route('payment.index', ['type' => 'subscription']) }}" class="btn btn-sm {{ request('type') == 'subscription' ? 'btn-primary' : 'btn-default' }}">Subscriptions</a>
                            <a href="{{ route('payment.index', ['type' => 'movie_purchase']) }}" class="btn btn-sm {{ request('type') == 'movie_purchase' ? 'btn-primary' : 'btn-default' }}">Movie Purchases</a>
                        </div>
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
                            @forelse ($payments as $payment)
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
                                <td colspan="8" class="text-center">No payments found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            {{ $payments->links() }}
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('payment.dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-chart-bar"></i> Payment Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

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
                    <h3 class="card-title">Payment History for {{ $user->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('payment.index') }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-left"></i> Back to Payments
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Related To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
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
                                    @if ($payment->detail && $payment->detail->payable)
                                        @if ($payment->detail->payable instanceof \App\Models\Order)
                                            <a href="{{ route('order.show', $payment->detail->payable) }}">
                                                Order #{{ $payment->detail->payable->id }}
                                            </a>
                                        @elseif ($payment->detail->payable instanceof \App\Models\Subscription)
                                            Subscription #{{ $payment->detail->payable->id }}
                                            ({{ $payment->detail->payable->plan->name }})
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('payment.show', $payment) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No payment history found for this user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

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
                    <h3 class="card-title">Payment #{{ $payment->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('payment.index') }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-left"></i> Back to Payments
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Payment Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">Payment ID</th>
                                    <td>{{ $payment->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td>
                                        {{ $payment->user->name }} ({{ $payment->user->email }})
                                        <a href="{{ route('payment.user-history', $payment->user) }}" class="btn btn-xs btn-info ml-2">
                                            <i class="fas fa-history"></i> View History
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Type</th>
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
                                </tr>
                                <tr>
                                    <th>Method</th>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <th>Transaction ID</th>
                                    <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>${{ number_format($payment->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Currency</th>
                                    <td>{{ $payment->currency }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
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
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if ($payment->notes)
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $payment->notes }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Related Information</h5>
                            @if ($payment->detail && $payment->detail->payable)
                                @if ($payment->detail->payable instanceof \App\Models\Order)
                                    <div class="alert alert-info">
                                        This payment is for an <strong>Order</strong>
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 30%">Order ID</th>
                                            <td>
                                                {{ $payment->detail->payable->id }}
                                                <a href="{{ route('order.show', $payment->detail->payable) }}" class="btn btn-xs btn-info ml-2">
                                                    <i class="fas fa-eye"></i> View Order
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <td>${{ number_format($payment->detail->payable->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($payment->detail->payable->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif ($payment->detail->payable->status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @elseif ($payment->detail->payable->status == 'cancelled')
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Items</th>
                                            <td>{{ $payment->detail->payable->items->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td>{{ $payment->detail->payable->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    </table>
                                @elseif ($payment->detail->payable instanceof \App\Models\Subscription)
                                    <div class="alert alert-primary">
                                        This payment is for a <strong>Subscription</strong>
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 30%">Subscription ID</th>
                                            <td>{{ $payment->detail->payable->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Plan</th>
                                            <td>{{ $payment->detail->payable->plan->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ number_format($payment->detail->payable->plan->price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($payment->detail->payable->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($payment->detail->payable->status == 'canceled')
                                                    <span class="badge bg-warning">Canceled</span>
                                                @elseif ($payment->detail->payable->status == 'expired')
                                                    <span class="badge bg-danger">Expired</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Start Date</th>
                                            <td>{{ $payment->detail->payable->start_date->format('M d, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>End Date</th>
                                            <td>
                                                @if ($payment->detail->payable->end_date)
                                                    {{ $payment->detail->payable->end_date->format('M d, Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                @endif
                            @else
                                <div class="alert alert-warning">
                                    No related information found for this payment.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('payment.update-status', $payment) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="input-group">
                            <select name="status" class="form-control">
                                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ $payment->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order #{{ $order->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('order.index') }}" class="btn btn-sm btn-default">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">Order ID</th>
                                    <td>{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($order->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif ($order->status == 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if ($order->notes)
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $order->notes }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Payment Information</h5>
                            @if ($order->paymentDetail && $order->paymentDetail->payment)
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 30%">Payment ID</th>
                                        <td>{{ $order->paymentDetail->payment->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Method</th>
                                        <td>{{ ucfirst($order->paymentDetail->payment->payment_method) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <td>{{ $order->paymentDetail->payment->transaction_id ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount</th>
                                        <td>${{ number_format($order->paymentDetail->payment->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($order->paymentDetail->payment->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($order->paymentDetail->payment->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif ($order->paymentDetail->payment->status == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @elseif ($order->paymentDetail->payment->status == 'refunded')
                                                <span class="badge bg-info">Refunded</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $order->paymentDetail->payment->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    No payment information found for this order.
                                </div>
                            @endif
                        </div>
                    </div>

                    <h5 class="mt-4">Order Items</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Movie</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if ($item->movie)
                                        {{ $item->movie->title }}
                                    @else
                                        <span class="text-muted">Movie not found</span>
                                    @endif
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($item->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif ($item->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No items found for this order.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('order.update-status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            @if (!$order->paymentDetail)
                                <form action="{{ route('order.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Order
                                    </button>
                                </form>
                            @endif
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

@extends('frontend.layouts.app')

@section('content')
<div class="mt-5">.
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between align-items-center">
                    <div class="iq-header-title">
                        <h4 class="card-title">Order Details #{{ $order->id }}</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <a href="{{ route('frontend.orders.history') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Order Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Order ID:</th>
                                            <td>#{{ $order->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                @if($order->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($order->status == 'completed')
                                                    <span class="badge badge-success">Completed</span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge badge-danger">Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Amount:</th>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Payment Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Payment Status:</th>
                                            <td>
                                                @if($order->paymentDetail && $order->paymentDetail->payment)
                                                    @if($order->paymentDetail->payment->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($order->paymentDetail->payment->status == 'completed')
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif($order->paymentDetail->payment->status == 'refunded')
                                                        <span class="badge badge-info">Refunded</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-secondary">Not Available</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if($order->paymentDetail && $order->paymentDetail->payment)
                                            <tr>
                                                <th>Payment Method:</th>
                                                <td>{{ ucfirst($order->paymentDetail->payment->payment_method) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Date:</th>
                                                <td>{{ $order->paymentDetail->payment->created_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Order Items</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Movie</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->movie->poster_url)
                                                            <img src="{{ $item->movie->poster_url }}" alt="{{ $item->movie->title }}" class="img-fluid mr-3" style="width: 50px;">
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0">{{ $item->movie->title }}</h6>
                                                            <small class="text-muted">{{ $item->movie->type }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>
                                                    @if($item->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($item->status == 'completed')
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif($item->status == 'cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 'completed')
                                                        <div class="iq-button">
                                                            <a href="{{ route('frontend.detail', $item->movie->id) }}" class="btn text-uppercase position-relative">
                                                                <span class="button-text">Watch Now</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

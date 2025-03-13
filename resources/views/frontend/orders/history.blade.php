@extends('frontend.layouts.app')

@section('content')
<div class="mt-5">.
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between align-items-center">
                    <div class="iq-header-title">
                        <h4 class="card-title">Order History</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('frontend.orders.history') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                            <a href="{{ route('frontend.orders.history', ['status' => 'pending']) }}" class="btn {{ request('status') == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">Pending</a>
                            <a href="{{ route('frontend.orders.history', ['status' => 'completed']) }}" class="btn {{ request('status') == 'completed' ? 'btn-primary' : 'btn-outline-primary' }}">Completed</a>
                            <a href="{{ route('frontend.orders.history', ['status' => 'cancelled']) }}" class="btn {{ request('status') == 'cancelled' ? 'btn-primary' : 'btn-outline-primary' }}">Cancelled</a>
                        </div>
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

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Items</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>
                                            <ul class="list-unstyled m-0">
                                                @foreach($order->items as $item)
                                                    <li>{{ $item->movie->title }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($order->status == 'completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge badge-danger">Cancelled</span>
                                            @endif
                                        </td>
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
                                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('frontend.orders.show', $order) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

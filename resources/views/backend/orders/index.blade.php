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
                    <h3 class="card-title">Orders</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="{{ route('order.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-default' }}">All</a>
                            <a href="{{ route('order.index', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-primary' : 'btn-default' }}">Pending</a>
                            <a href="{{ route('order.index', ['status' => 'completed']) }}" class="btn btn-sm {{ request('status') == 'completed' ? 'btn-primary' : 'btn-default' }}">Completed</a>
                            <a href="{{ route('order.index', ['status' => 'cancelled']) }}" class="btn btn-sm {{ request('status') == 'cancelled' ? 'btn-primary' : 'btn-default' }}">Cancelled</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Items</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if ($order->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $order->items->count() }}</td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('order.show', $order) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
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
                <div class="card-footer">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

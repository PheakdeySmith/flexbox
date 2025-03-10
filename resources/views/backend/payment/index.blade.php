@extends('backend.layouts.app')

@section('title', 'Payments')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Payments</h3>
                            <div class="card-tools">
                                <a href="{{ route('payment.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create New Payment
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            @if(count($payments) > 0)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Subscription</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->user->name }}</td>
                                                <td>
                                                    @if($payment->subscription)
                                                        <a href="{{ route('subscription.show', $payment->subscription->id) }}">
                                                            {{ $payment->subscription->subscriptionPlan->name }}
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>${{ number_format($payment->amount, 2) }}</td>
                                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                                <td>
                                                    @if($payment->status == 'completed')
                                                        <span class="badge badge-success">Completed</span>
                                                    @elseif($payment->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($payment->status == 'failed')
                                                        <span class="badge badge-danger">Failed</span>
                                                    @else
                                                        <span class="badge badge-secondary">{{ $payment->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info m-3">
                                    No payments found. <a href="{{ route('payment.create') }}">Create a new payment</a>.
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $payments->links() }}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

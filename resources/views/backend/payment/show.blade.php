@extends('backend.layouts.app')

@section('title', 'View Payment')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">Payments</a></li>
                        <li class="breadcrumb-item active">View</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Details</h3>
                            <div class="card-tools">
                                <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Payment ID:</label>
                                        <p>{{ $payment->id }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>User:</label>
                                        <p>
                                            <a href="{{ route('user.show', $payment->user->id) }}">
                                                {{ $payment->user->name }} ({{ $payment->user->email }})
                                            </a>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount:</label>
                                        <p>${{ number_format($payment->amount, 2) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Method:</label>
                                        <p>{{ ucfirst($payment->payment_method) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <p>
                                            @if($payment->status == 'completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif($payment->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($payment->status == 'failed')
                                                <span class="badge badge-danger">Failed</span>
                                            @elseif($payment->status == 'refunded')
                                                <span class="badge badge-info">Refunded</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $payment->status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Transaction ID:</label>
                                        <p>{{ $payment->transaction_id ?? 'N/A' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Date:</label>
                                        <p>{{ $payment->created_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Updated:</label>
                                        <p>{{ $payment->updated_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($payment->subscription)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h4>Related Subscription</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width: 200px;">Subscription ID</th>
                                                <td>{{ $payment->subscription->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Plan</th>
                                                <td>
                                                    <a href="{{ route('subscription-plan.show', $payment->subscription->subscriptionPlan->id) }}">
                                                        {{ $payment->subscription->subscriptionPlan->name }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if($payment->subscription->status == 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @elseif($payment->subscription->status == 'canceled')
                                                        <span class="badge badge-danger">Canceled</span>
                                                    @elseif($payment->subscription->status == 'expired')
                                                        <span class="badge badge-warning">Expired</span>
                                                    @else
                                                        <span class="badge badge-secondary">{{ $payment->subscription->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Period</th>
                                                <td>{{ $payment->subscription->start_date->format('M d, Y') }} to {{ $payment->subscription->end_date->format('M d, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Actions</th>
                                                <td>
                                                    <a href="{{ route('subscription.show', $payment->subscription->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> View Subscription
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($payment->notes)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h4>Notes</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $payment->notes }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route('payment.index') }}" class="btn btn-default">Back to List</a>

                            @if($payment->status == 'pending')
                                <form action="{{ route('payment.mark-as-completed', $payment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Mark as Completed
                                    </button>
                                </form>
                            @endif

                            @if($payment->status == 'completed' && !$payment->status == 'refunded')
                                <form action="{{ route('payment.mark-as-refunded', $payment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-undo"></i> Mark as Refunded
                                    </button>
                                </form>
                            @endif
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

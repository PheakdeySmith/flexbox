@extends('backend.layouts.app')

@php
use Illuminate\Support\Facades\Schema;
@endphp

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Flash Message Display -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for flash messages
            @if (session('success'))
                showSuccessToast("{{ session('success') }}");
            @endif

            @if (session('error'))
                showErrorToast("{{ session('error') }}");
            @endif
        });
    </script>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Management</h3>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="paymentsTable" class="table table-bordered table-striped">
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
                                            <a href="{{ route('payment.show', $payment) }}" class="btn btn-info btn-sm">
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
                                <tfoot>
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
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="row">
                                <div class="col-md-12 text-right">
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
    </section>
</div>

<script>
    $(function () {
        $("#paymentsTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 15,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#paymentsTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection



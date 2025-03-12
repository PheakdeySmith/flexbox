@extends('backend.layouts.app')

@section('title', 'View Subscription')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Subscription</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subscription.index') }}">Subscriptions</a></li>
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
                            <h3 class="card-title">Subscription Details</h3>
                            <div class="card-tools">
                                <a href="{{ route('subscription.edit', $subscription->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('subscription.destroy', $subscription->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subscription?')">
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
                                        <label>Subscription ID:</label>
                                        <p>{{ $subscription->id }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>User:</label>
                                        <p>
                                            <a href="{{ route('user.show', $subscription->user->id) }}">
                                                {{ $subscription->user->name }} ({{ $subscription->user->email }})
                                            </a>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Subscription Plan:</label>
                                        <p>
                                            <a href="{{ route('subscription-plan.show', $subscription->plan->id) }}">
                                                {{ $subscription->plan->name }}
                                            </a>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Price:</label>
                                        <p>${{ number_format($subscription->plan->price, 2) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Duration:</label>
                                        <p>{{ $subscription->plan->duration_in_days }} days</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <p>
                                            @if($subscription->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($subscription->status == 'canceled')
                                                <span class="badge badge-danger">Canceled</span>
                                            @elseif($subscription->status == 'expired')
                                                <span class="badge badge-warning">Expired</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $subscription->status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <p>{{ $subscription->start_date->format('F d, Y') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>End Date:</label>
                                        <p>{{ $subscription->end_date->format('F d, Y') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Auto Renew:</label>
                                        <p>
                                            @if($subscription->auto_renew)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Stripe ID:</label>
                                        <p>{{ $subscription->stripe_id ?? 'Not set' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h4>Subscription Timeline</h4>
                                    <div class="timeline">
                                        <!-- Created -->
                                        <div>
                                            <i class="fas fa-plus bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ $subscription->created_at->format('M d, Y h:i A') }}</span>
                                                <h3 class="timeline-header">Subscription Created</h3>
                                                <div class="timeline-body">
                                                    Subscription was created for {{ $subscription->user->name }}.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Started -->
                                        <div>
                                            <i class="fas fa-play bg-success"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ $subscription->start_date->format('M d, Y') }}</span>
                                                <h3 class="timeline-header">Subscription Started</h3>
                                                <div class="timeline-body">
                                                    Subscription period began.
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Canceled (if applicable) -->
                                        @if($subscription->canceled_at)
                                        <div>
                                            <i class="fas fa-ban bg-danger"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ $subscription->canceled_at->format('M d, Y h:i A') }}</span>
                                                <h3 class="timeline-header">Subscription Canceled</h3>
                                                <div class="timeline-body">
                                                    Subscription was canceled but remains active until the end date.
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- End Date -->
                                        <div>
                                            <i class="fas fa-stop bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ $subscription->end_date->format('M d, Y') }}</span>
                                                <h3 class="timeline-header">Subscription End Date</h3>
                                                <div class="timeline-body">
                                                    @if($subscription->end_date->isPast())
                                                        Subscription period ended.
                                                    @else
                                                        Subscription will end on this date.
                                                        @if($subscription->auto_renew)
                                                            <br>Subscription is set to auto-renew.
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route('subscription.index') }}" class="btn btn-default">Back to List</a>
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

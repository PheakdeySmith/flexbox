@extends('backend.layouts.app')

@section('title', 'View Subscription Plan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Subscription Plan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subscription-plan.index') }}">Subscription Plans</a></li>
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
                            <h3 class="card-title">{{ $subscriptionPlan->name }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('subscription-plan.edit', $subscriptionPlan->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('subscription-plan.destroy', $subscriptionPlan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">
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
                                        <label>Name:</label>
                                        <p>{{ $subscriptionPlan->name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <p>{{ $subscriptionPlan->description }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Price:</label>
                                        <p>${{ number_format($subscriptionPlan->price, 2) }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Duration:</label>
                                        <p>{{ $subscriptionPlan->duration_in_days }} days</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Features:</label>
                                        @if(is_array($subscriptionPlan->features) && count($subscriptionPlan->features) > 0)
                                            <ul class="list-group">
                                                @foreach($subscriptionPlan->features as $feature)
                                                    <li class="list-group-item">{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No features specified for this plan.</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <p>
                                            @if($subscriptionPlan->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Created At:</label>
                                        <p>{{ $subscriptionPlan->created_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Updated:</label>
                                        <p>{{ $subscriptionPlan->updated_at->format('F d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route('subscription-plan.index') }}" class="btn btn-default">Back to List</a>
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

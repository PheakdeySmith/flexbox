@extends('backend.layouts.app')

@section('title', 'Edit Subscription')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Subscription</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subscription.index') }}">Subscriptions</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Subscription</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('subscription.update', $subscription->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $subscription->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subscription_plan_id">Subscription Plan</label>
                                    <select class="form-control @error('subscription_plan_id') is-invalid @enderror" id="subscription_plan_id" name="subscription_plan_id">
                                        <option value="">Select Plan</option>
                                        @foreach($subscriptionPlans as $plan)
                                            <option value="{{ $plan->id }}" {{ old('subscription_plan_id', $subscription->subscription_plan_id) == $plan->id ? 'selected' : '' }}>
                                                {{ $plan->name }} - ${{ number_format($plan->price, 2) }} / {{ $plan->duration }} days
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subscription_plan_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="active" {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="canceled" {{ old('status', $subscription->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        <option value="expired" {{ old('status', $subscription->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $subscription->start_date->format('Y-m-d')) }}">
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $subscription->end_date->format('Y-m-d')) }}">
                                            @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="auto_renew" name="auto_renew" value="1" {{ old('auto_renew', $subscription->auto_renew) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="auto_renew">Auto Renew</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stripe_id">Stripe ID (optional)</label>
                                    <input type="text" class="form-control @error('stripe_id') is-invalid @enderror" id="stripe_id" name="stripe_id" placeholder="Enter Stripe ID" value="{{ old('stripe_id', $subscription->stripe_id) }}">
                                    @error('stripe_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('subscription.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Initialize Select2
        $('.select2').select2();

        // Update end date when plan or start date changes
        $('#subscription_plan_id, #start_date').on('change', function() {
            const planId = $('#subscription_plan_id').val();
            const startDate = $('#start_date').val();

            if (planId && startDate) {
                // Find the selected plan's duration
                const selectedOption = $('#subscription_plan_id option:selected');
                const durationText = selectedOption.text();
                const durationMatch = durationText.match(/(\d+) days/);

                if (durationMatch && durationMatch[1]) {
                    const duration = parseInt(durationMatch[1]);

                    // Calculate end date
                    const start = new Date(startDate);
                    const end = new Date(start);
                    end.setDate(start.getDate() + duration);

                    // Format date as YYYY-MM-DD
                    const endFormatted = end.toISOString().split('T')[0];
                    $('#end_date').val(endFormatted);
                }
            }
        });
    });
</script>
@endpush

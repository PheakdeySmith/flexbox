@extends('backend.layouts.app')

@section('title', 'Create Subscription')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Subscription</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subscription.index') }}">Subscriptions</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Create New Subscription</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('subscription.store') }}">
                            @csrf
                            <div class="card-body">
                                <!-- User and Plan Selection -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Subscriber Information</h5>
                                        <div class="form-group">
                                            <label for="user_id">Select User <span class="text-danger">*</span></label>
                                            <select class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" name="user_id" style="width: 100%;">
                                                <option value="">-- Select User --</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">User who will own this subscription</small>
                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="mb-3">Plan Information</h5>
                                        <div class="form-group">
                                            <label for="subscription_plan_id">Select Plan <span class="text-danger">*</span></label>
                                            <select class="form-control select2 @error('subscription_plan_id') is-invalid @enderror" id="subscription_plan_id" name="subscription_plan_id" style="width: 100%;">
                                                <option value="">-- Select Plan --</option>
                                                @foreach($subscriptionPlans as $plan)
                                                    <option value="{{ $plan->id }}"
                                                        data-duration="{{ $plan->duration_in_days }}"
                                                        data-price="{{ $plan->price }}"
                                                        data-trial="{{ $plan->has_trial ? $plan->trial_days : 0 }}"
                                                        {{ old('subscription_plan_id') == $plan->id ? 'selected' : '' }}>
                                                        {{ $plan->name }} - ${{ number_format($plan->price, 2) }} / {{ ucfirst($plan->billing_cycle) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Subscription plan to assign</small>
                                            @error('subscription_plan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="plan-details mt-3 p-3 bg-light rounded" style="display: none;">
                                            <h6 class="font-weight-bold">Plan Details</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Price:</strong> $<span id="plan-price">0.00</span></p>
                                                    <p><strong>Duration:</strong> <span id="plan-duration">0</span> days</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Trial Period:</strong> <span id="plan-trial">0</span> days</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <!-- Subscription Details -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Subscription Period</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}">
                                                    </div>
                                                    @error('start_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', date('Y-m-d', strtotime('+30 days'))) }}">
                                                    </div>
                                                    @error('end_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="trial_ends_at">Trial End Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                                </div>
                                                <input type="date" class="form-control @error('trial_ends_at') is-invalid @enderror" id="trial_ends_at" name="trial_ends_at" value="{{ old('trial_ends_at') }}">
                                            </div>
                                            <small class="form-text text-muted">Leave empty if no trial period</small>
                                            @error('trial_ends_at')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="mb-3">Subscription Settings</h5>
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="auto_renew" name="auto_renew" value="1" {{ old('auto_renew') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="auto_renew">Auto Renew</label>
                                            </div>
                                            <small class="form-text text-muted">If enabled, subscription will automatically renew when it expires</small>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <!-- Payment Integration -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-3">Payment Integration (Optional)</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="stripe_id">Stripe Subscription ID</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fab fa-stripe"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control @error('stripe_id') is-invalid @enderror" id="stripe_id" name="stripe_id" placeholder="e.g. sub_1NhJ2bCZ6qsJgndJYX6Ij" value="{{ old('stripe_id') }}">
                                                    </div>
                                                    @error('stripe_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="stripe_status">Stripe Status</label>
                                                    <input type="text" class="form-control @error('stripe_status') is-invalid @enderror" id="stripe_status" name="stripe_status" placeholder="e.g. active" value="{{ old('stripe_status') }}">
                                                    @error('stripe_status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="stripe_price">Stripe Price ID</label>
                                                    <input type="text" class="form-control @error('stripe_price') is-invalid @enderror" id="stripe_price" name="stripe_price" placeholder="e.g. price_1NhJ2bCZ6qsJgndJYX6Ij" value="{{ old('stripe_price') }}">
                                                    @error('stripe_price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Create Subscription
                                </button>
                                <a href="{{ route('subscription.index') }}" class="btn btn-default">
                                    <i class="fas fa-times-circle mr-1"></i> Cancel
                                </a>
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
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Update end date and trial date when plan or start date changes
    $('#subscription_plan_id, #start_date').on('change', function() {
        updateDates();
        updatePlanDetails();
    });

    // Initial update
    updateDates();
    updatePlanDetails();

    function updateDates() {
        const planId = $('#subscription_plan_id').val();
        const startDate = $('#start_date').val();

        if (planId && startDate) {
            const selectedOption = $('#subscription_plan_id option:selected');
            const duration = parseInt(selectedOption.data('duration'));
            const trialDays = parseInt(selectedOption.data('trial'));

            if (duration) {
                // Calculate end date
                const start = new Date(startDate);
                const end = new Date(start);
                end.setDate(start.getDate() + duration);

                // Format date as YYYY-MM-DD
                const endFormatted = end.toISOString().split('T')[0];
                $('#end_date').val(endFormatted);

                // Calculate trial end date if trial exists
                if (trialDays > 0) {
                    const trialEnd = new Date(start);
                    trialEnd.setDate(start.getDate() + trialDays);
                    const trialEndFormatted = trialEnd.toISOString().split('T')[0];
                    $('#trial_ends_at').val(trialEndFormatted);
                } else {
                    $('#trial_ends_at').val('');
                }
            }
        }
    }

    function updatePlanDetails() {
        const selectedOption = $('#subscription_plan_id option:selected');

        if (selectedOption.val()) {
            // Update plan details
            $('#plan-price').text(parseFloat(selectedOption.data('price')).toFixed(2));
            $('#plan-duration').text(selectedOption.data('duration'));
            $('#plan-trial').text(selectedOption.data('trial'));

            // Show plan details
            $('.plan-details').slideDown();
        } else {
            // Hide plan details if no plan selected
            $('.plan-details').slideUp();
        }
    }
});
</script>
@endpush

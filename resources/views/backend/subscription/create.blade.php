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
                                                <option value=""></option>
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
                                                <option value=""></option>
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
                                                        <input type="text" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', date('m/d/Y')) }}" readonly>
                                                    </div>
                                                    <small class="form-text text-muted">Start date is set to today and will be used for calculations</small>
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
                                                        <input type="text" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="" readonly>
                                                    </div>
                                                    <small class="form-text text-muted">End date is calculated based on the selected plan</small>
                                                    @error('end_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
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

                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle mr-1"></i> Review the subscription details before creating.
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

@push('footer_scripts')
<script>
$(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    }).on('select2:select', function(e) {
        if ($(this).attr('id') === 'subscription_plan_id') {
            updateDates();
            updatePlanDetails();
        }
    });

    // Add hidden fields for actual date values
    $('<input>').attr({
        type: 'hidden',
        id: 'start_date_hidden',
        name: 'start_date'
    }).insertAfter('#start_date');

    $('<input>').attr({
        type: 'hidden',
        id: 'end_date_hidden',
        name: 'end_date'
    }).insertAfter('#end_date');

    $('<input>').attr({
        type: 'hidden',
        id: 'trial_ends_at_hidden',
        name: 'trial_ends_at'
    }).insertAfter('#trial_ends_at');

    // Remove name attribute from display fields to prevent them from being submitted
    $('#start_date').removeAttr('name');
    $('#end_date').removeAttr('name');
    $('#trial_ends_at').removeAttr('name');

    // Set default start date to today
    const today = new Date();
    const formattedToday = formatDate(today);
    $('#start_date').val(formattedToday);
    $('#start_date_hidden').val(formatDateForServer(today));

    // Regular change handler
    $('#subscription_plan_id').on('change', function() {
        updateDates();
        updatePlanDetails();
    });

    // Trigger change event on page load to calculate initial dates
    setTimeout(function() {
        const currentPlanId = $('#subscription_plan_id').val();
        if (currentPlanId) {
            updateDates();
            updatePlanDetails();
        }
    }, 500);

    function updateDates() {
        const planId = $('#subscription_plan_id').val();
        const startDateStr = $('#start_date').val();

        if (planId && startDateStr) {
            // Parse the displayed date (MM/DD/YYYY)
            const startParts = startDateStr.split('/');
            const start = new Date(startParts[2], startParts[0] - 1, startParts[1]);

            const selectedOption = $('#subscription_plan_id option:selected');
            const duration = parseInt(selectedOption.data('duration'));
            const trialDays = parseInt(selectedOption.data('trial'));

            if (duration) {
                // Calculate end date
                const end = new Date(start);

                // For lifetime plans (duration >= 36500 days)
                if (duration >= 36500) {
                    // Cap at 10 years for lifetime plans
                    end.setFullYear(start.getFullYear() + 10);

                    // Add a special indicator for lifetime plans
                    const endFormatted = formatDate(end) + " (Lifetime)";
                    const endFormattedServer = formatDateForServer(end);

                    // Update display and hidden fields
                    $('#end_date').val(endFormatted);
                    $('#end_date_hidden').val(endFormattedServer);

                    // Log for debugging
                    console.log('Lifetime plan selected. End date:', endFormattedServer);
                } else {
                    // For normal plans, use the actual duration
                    end.setDate(start.getDate() + duration);

                    // Format dates for display and server
                    const endFormatted = formatDate(end);
                    const endFormattedServer = formatDateForServer(end);

                    // Update display and hidden fields
                    $('#end_date').val(endFormatted);
                    $('#end_date_hidden').val(endFormattedServer);

                    // Log for debugging
                    console.log('Regular plan selected. End date:', endFormattedServer);
                }

                // Calculate trial end date if trial exists
                if (trialDays > 0) {
                    const trialEnd = new Date(start);
                    trialEnd.setDate(start.getDate() + trialDays);

                    const trialEndFormatted = formatDate(trialEnd);
                    const trialEndFormattedServer = formatDateForServer(trialEnd);

                    $('#trial_ends_at').val(trialEndFormatted);
                    $('#trial_ends_at_hidden').val(trialEndFormattedServer);
                } else {
                    $('#trial_ends_at').val('');
                    $('#trial_ends_at_hidden').val('');
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

    // Helper function to format date as MM/DD/YYYY for display
    function formatDate(date) {
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    // Helper function to format date as YYYY-MM-DD for server
    function formatDateForServer(date) {
        // Ensure we're working with a valid date object
        if (!(date instanceof Date) || isNaN(date)) {
            console.error('Invalid date object:', date);
            // Return a safe default (today's date)
            const today = new Date();
            const month = (today.getMonth() + 1).toString().padStart(2, '0');
            const day = today.getDate().toString().padStart(2, '0');
            const year = today.getFullYear();
            return `${year}-${month}-${day}`;
        }

        // For lifetime plans, if the year is too far in the future, cap it at 10 years from now
        const currentYear = new Date().getFullYear();
        if (date.getFullYear() > currentYear + 10) {
            console.log('Date too far in future, capping at 10 years:', date);
            const cappedDate = new Date();
            cappedDate.setFullYear(currentYear + 10);
            date = cappedDate;
        }

        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const year = date.getFullYear();

        console.log('Formatted date for server:', `${year}-${month}-${day}`);
        return `${year}-${month}-${day}`;
    }
});
</script>
@endpush

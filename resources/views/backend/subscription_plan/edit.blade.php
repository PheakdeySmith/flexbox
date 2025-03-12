@extends('backend.layouts.app')

@section('title', 'Edit Subscription Plan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Subscription Plan: {{ $subscriptionPlan->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('subscription-plan.index') }}">Subscription Plans</a></li>
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
                            <h3 class="card-title">Edit Subscription Plan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('subscription-plan.update', $subscriptionPlan->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Basic Information</h5>
                                        <div class="form-group">
                                            <label for="name">Plan Name <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter plan name" value="{{ old('name', $subscriptionPlan->name) }}">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Enter slug or leave empty to auto-generate" value="{{ old('slug', $subscriptionPlan->slug) }}">
                                            </div>
                                            <small class="form-text text-muted">Leave empty to auto-generate from name</small>
                                            @error('slug')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter plan description">{{ old('description', $subscriptionPlan->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="mb-3">Pricing & Duration</h5>
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter price" value="{{ old('price', $subscriptionPlan->price) }}">
                                            </div>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="billing_cycle">Billing Cycle <span class="text-danger">*</span></label>
                                            <select class="form-control @error('billing_cycle') is-invalid @enderror" id="billing_cycle" name="billing_cycle">
                                                <option value="monthly" {{ old('billing_cycle', $subscriptionPlan->billing_cycle) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="quarterly" {{ old('billing_cycle', $subscriptionPlan->billing_cycle) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                                <option value="biannually" {{ old('billing_cycle', $subscriptionPlan->billing_cycle) == 'biannually' ? 'selected' : '' }}>Biannually</option>
                                                <option value="annually" {{ old('billing_cycle', $subscriptionPlan->billing_cycle) == 'annually' ? 'selected' : '' }}>Annually</option>
                                            </select>
                                            @error('billing_cycle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="duration_in_days">Duration (days) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="number" min="1" class="form-control @error('duration_in_days') is-invalid @enderror" id="duration_in_days" name="duration_in_days" placeholder="Enter duration in days" value="{{ old('duration_in_days', $subscriptionPlan->duration_in_days) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">days</span>
                                                </div>
                                            </div>
                                            @error('duration_in_days')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Features</h5>
                                        <div class="form-group">
                                            <label for="features">Features (one per line)</label>
                                            <textarea class="form-control @error('features') is-invalid @enderror" id="features" name="features" rows="6" placeholder="Enter features, one per line">{{ old('features', is_array($subscriptionPlan->features) ? implode("\n", $subscriptionPlan->features) : $subscriptionPlan->features) }}</textarea>
                                            <small class="form-text text-muted">Enter each feature on a new line. These will be displayed as bullet points.</small>
                                            @error('features')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="mb-3">Trial Settings</h5>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="has_trial" name="has_trial" value="1" {{ old('has_trial', $subscriptionPlan->has_trial) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="has_trial">Enable Free Trial</label>
                                            </div>
                                        </div>

                                        <div class="form-group" id="trial_days_group" style="{{ old('has_trial', $subscriptionPlan->has_trial) ? '' : 'display: none;' }}">
                                            <label for="trial_days">Trial Period (days)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                </div>
                                                <input type="number" min="1" class="form-control @error('trial_days') is-invalid @enderror" id="trial_days" name="trial_days" placeholder="Enter trial period in days" value="{{ old('trial_days', $subscriptionPlan->trial_days) }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">days</span>
                                                </div>
                                            </div>
                                            @error('trial_days')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <h5 class="mb-3 mt-4">Status & Integration</h5>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $subscriptionPlan->is_active) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_active">Active</label>
                                            </div>
                                            <small class="form-text text-muted">If disabled, users won't be able to subscribe to this plan</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="stripe_price_id">Stripe Price ID</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fab fa-stripe"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('stripe_price_id') is-invalid @enderror" id="stripe_price_id" name="stripe_price_id" placeholder="e.g. price_1NhJ2bCZ6qsJgndJYX6Ij" value="{{ old('stripe_price_id', $subscriptionPlan->stripe_price_id) }}">
                                            </div>
                                            <small class="form-text text-muted">Required for Stripe integration</small>
                                            @error('stripe_price_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Update Plan
                                </button>
                                <a href="{{ route('subscription-plan.index') }}" class="btn btn-default">
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
    // Toggle trial days input based on has_trial checkbox
    $('#has_trial').on('change', function() {
        if ($(this).is(':checked')) {
            $('#trial_days_group').show();
        } else {
            $('#trial_days_group').hide();
        }
    });

    // Auto-generate slug from name
    $('#name').on('blur', function() {
        if ($('#slug').val() === '') {
            const name = $(this).val();
            const slug = name.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $('#slug').val(slug);
        }
    });

    // Set default values for billing cycle
    $('#billing_cycle').on('change', function() {
        const cycle = $(this).val();
        let days = 0;

        switch(cycle) {
            case 'monthly':
                days = 30;
                break;
            case 'quarterly':
                days = 90;
                break;
            case 'biannually':
                days = 180;
                break;
            case 'annually':
                days = 365;
                break;
        }

        if (days > 0 && confirm('Would you like to update the duration to ' + days + ' days to match the ' + cycle + ' billing cycle?')) {
            $('#duration_in_days').val(days);
        }
    });
});
</script>
@endpush

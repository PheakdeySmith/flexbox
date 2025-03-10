@extends('backend.layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">Payments</a></li>
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
                            <h3 class="card-title">Edit Payment</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('payment.update', $payment->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $payment->user_id) == $user->id ? 'selected' : '' }}>
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
                                    <label for="subscription_id">Subscription (Optional)</label>
                                    <select class="form-control @error('subscription_id') is-invalid @enderror" id="subscription_id" name="subscription_id">
                                        <option value="">Select Subscription</option>
                                        @foreach($subscriptions as $subscription)
                                            <option value="{{ $subscription->id }}" {{ old('subscription_id', $payment->subscription_id) == $subscription->id ? 'selected' : '' }}>
                                                {{ $subscription->user->name }} - {{ $subscription->subscriptionPlan->name }} ({{ $subscription->start_date->format('M d, Y') }} to {{ $subscription->end_date->format('M d, Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subscription_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Enter amount" value="{{ old('amount', $payment->amount) }}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                                        <option value="credit_card" {{ old('payment_method', $payment->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="paypal" {{ old('payment_method', $payment->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="stripe" {{ old('payment_method', $payment->payment_method) == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                        <option value="other" {{ old('payment_method', $payment->payment_method) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('payment_method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID (Optional)</label>
                                    <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" id="transaction_id" name="transaction_id" placeholder="Enter transaction ID" value="{{ old('transaction_id', $payment->transaction_id) }}">
                                    @error('transaction_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="completed" {{ old('status', $payment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ old('status', $payment->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes (Optional)</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="Enter payment notes">{{ old('notes', $payment->notes) }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('payment.index') }}" class="btn btn-default">Cancel</a>
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

        // When user is selected, filter subscriptions
        $('#user_id').on('change', function() {
            const userId = $(this).val();
            const subscriptionSelect = $('#subscription_id');
            const currentSubscriptionId = '{{ old('subscription_id', $payment->subscription_id) }}';

            // Reset subscription select
            subscriptionSelect.empty().append('<option value="">Select Subscription</option>');

            if (userId) {
                // Filter subscriptions by user
                @foreach($subscriptions as $subscription)
                    if ('{{ $subscription->user_id }}' == userId) {
                        const option = $('<option>', {
                            value: '{{ $subscription->id }}',
                            text: '{{ $subscription->subscriptionPlan->name }} ({{ $subscription->start_date->format("M d, Y") }} to {{ $subscription->end_date->format("M d, Y") }})'
                        });

                        if ('{{ $subscription->id }}' == currentSubscriptionId) {
                            option.attr('selected', 'selected');
                        }

                        subscriptionSelect.append(option);
                    }
                @endforeach
            }
        });
    });
</script>
@endpush

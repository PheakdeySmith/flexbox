@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">Subscription Checkout</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.subscription') }}">Pricing Plan</a></li>
                <li class="breadcrumb-item active">Checkout</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> <!--bread-crumb-->

    <div class="section-padding">
      <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($hasActiveSubscription)
            <div class="alert alert-warning">
                <strong>Warning:</strong> You already have an active subscription. Subscribing to a new plan will replace your current subscription.
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary">
                        <h4>Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('frontend.subscribe', $plan->id) }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror">
                                        <option value="">Select Payment Method</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div id="credit_card_fields" class="d-none">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="card_number" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="card_number" placeholder="1234 5678 9012 3456">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="expiry_date" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiry_date" placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" placeholder="123">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="card_name" class="form-label">Name on Card</label>
                                        <input type="text" class="form-control" id="card_name" placeholder="John Doe">
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input @error('agree_terms') is-invalid @enderror" type="checkbox" name="agree_terms" id="agree_terms">
                                <label class="form-check-label" for="agree_terms">
                                    I agree to the <a href="#" class="text-primary">Terms and Conditions</a>
                                </label>
                                @error('agree_terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Complete Subscription</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary">
                        <h4>Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3">{{ $plan->name }}</h5>
                        <p>{{ $plan->description }}</p>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Price:</span>
                            <span>${{ number_format($plan->price, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Billing Cycle:</span>
                            <span>{{ ucfirst($plan->billing_cycle) }}</span>
                        </div>

                        @if($plan->has_trial)
                        <div class="d-flex justify-content-between mb-2">
                            <span>Free Trial:</span>
                            <span>{{ $plan->trial_days }} days</span>
                        </div>
                        @endif

                        <hr>

                        <div class="d-flex justify-content-between mb-2 fw-bold">
                            <span>Total:</span>
                            <span>${{ number_format($plan->price, 2) }}</span>
                        </div>

                        <div class="mt-3">
                            <h6>Features:</h6>
                            <ul class="list-unstyled">
                                @foreach($plan->features as $feature)
                                <li><i class="fas fa-check text-success me-2"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#payment_method').on('change', function() {
            if ($(this).val() === 'credit_card') {
                $('#credit_card_fields').removeClass('d-none');
            } else {
                $('#credit_card_fields').addClass('d-none');
            }
        });
    });
</script>
@endpush

@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">Subscription Details</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.subscription') }}">Pricing Plan</a></li>
                <li class="breadcrumb-item active">Subscription Details</li>
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

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4>Subscription Details</h4>
                        <div>
                            @if($subscription->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($subscription->status === 'canceled')
                                <span class="badge bg-warning">Canceled</span>
                            @else
                                <span class="badge bg-danger">Expired</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>Plan Information</h5>
                                <p><strong>Plan Name:</strong> {{ $subscription->plan->name }}</p>
                                <p><strong>Price:</strong> ${{ number_format($subscription->plan->price, 2) }}</p>
                                <p><strong>Billing Cycle:</strong> {{ ucfirst($subscription->plan->billing_cycle) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Subscription Dates</h5>
                                <p><strong>Start Date:</strong> {{ $subscription->start_date->format('M d, Y') }}</p>
                                <p><strong>End Date:</strong>
                                    @if($subscription->plan->duration_in_days > 3650)
                                        Lifetime
                                    @else
                                        {{ $subscription->end_date->format('M d, Y') }}
                                    @endif
                                </p>
                                @if($subscription->trial_ends_at && $subscription->trial_ends_at->isFuture())
                                    <p><strong>Trial Ends:</strong> {{ $subscription->trial_ends_at->format('M d, Y') }}</p>
                                @endif
                                @if($subscription->canceled_at)
                                    <p><strong>Canceled On:</strong> {{ $subscription->canceled_at->format('M d, Y') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>Features</h5>
                                <ul class="list-group">
                                    @foreach($subscription->plan->features as $feature)
                                        <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @if($subscription->status === 'active')
                            <div class="mt-4">
                                <button href="#" class="btn btn-primary btn-remove"
                                    data-id="{{ $subscription->id }}"
                                    data-url="{{ route('frontend.cancelSubscription', $subscription->id) }}">
                                    Cancel Subscription
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                @if($subscription->payments->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4>Payment History</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subscription->payments as $payment)
                                            <tr>
                                                <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                                <td>${{ number_format($payment->amount, 2) }}</td>
                                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                                <td>
                                                    @if($payment->status === 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif($payment->status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($payment->status === 'trial')
                                                        <span class="badge bg-info">Trial</span>
                                                    @elseif($payment->status === 'failed')
                                                        <span class="badge bg-danger">Failed</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $payment->notes }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4>Subscription FAQ</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="subscriptionFaq">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How do I cancel my subscription?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#subscriptionFaq">
                                    <div class="accordion-body">
                                        You can cancel your subscription at any time by clicking the "Cancel Subscription" button on this page. Your subscription will remain active until the end of the current billing period.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Can I upgrade my plan?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#subscriptionFaq">
                                    <div class="accordion-body">
                                        Yes, you can upgrade your plan at any time. Simply go to the subscription page and select a new plan. Your current subscription will be replaced with the new one.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Will I get a refund if I cancel?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#subscriptionFaq">
                                    <div class="accordion-body">
                                        We do not provide refunds for canceled subscriptions. Your subscription will remain active until the end of the current billing period.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-remove').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const subscriptionId = this.getAttribute('data-id');
                const cancelUrl = this.getAttribute('data-url');
                const item = this.closest('.block-images');

                Swal.fire({
                    title: 'Cancel Subscription?',
                    text: 'Are you sure you want to cancel this subscription?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then(result => {
                    if (result.isConfirmed) {
                        // Create a form dynamically
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = cancelUrl;
                        form.style.display = 'none';

                        // CSRF Token and Cancel Method
                        form.appendChild(createInput('_token', '{{ csrf_token() }}'));
                        form.appendChild(createInput('_method', 'POST'));

                        document.body.appendChild(form);
                        form.submit();

                        // Remove item visually
                        item.style.transition = 'all 0.4s ease';
                        item.style.opacity = '0';
                        setTimeout(() => item.remove(), 400);
                    }
                });
            });
        });
    });

    // Function to create hidden input elements
    function createInput(name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        return input;
    }
</script>
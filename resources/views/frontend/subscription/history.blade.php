@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">Subscription History</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.subscription') }}">Pricing Plan</a></li>
                <li class="breadcrumb-item active">Subscription History</li>
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
                    <div class="card-header bg-primary text-white">
                        <h4>Your Subscriptions</h4>
                    </div>
                    <div class="card-body">
                        @if($subscriptions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Plan</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subscriptions as $subscription)
                                            <tr>
                                                <td>{{ $subscription->plan->name }}</td>
                                                <td>{{ $subscription->start_date->format('M d, Y') }}</td>
                                                <td>
                                                    @if($subscription->plan->duration_in_days > 3650)
                                                        Lifetime
                                                    @else
                                                        {{ $subscription->end_date->format('M d, Y') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subscription->status === 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($subscription->status === 'canceled')
                                                        <span class="badge bg-warning">Canceled</span>
                                                    @else
                                                        <span class="badge bg-danger">Expired</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('frontend.subscriptionDetail', $subscription->id) }}" class="btn btn-sm btn-outline-info">View</a>

                                                    @if($subscription->status === 'active')
                                                            <button href="#" class="btn btn-sm btn-primary btn-remove"
                                                                        data-id="{{ $activeSubscription->id }}"
                                                                        data-url="{{ route('frontend.cancelSubscription', $activeSubscription->id) }}">
                                                                        Cancel
                                                            </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $subscriptions->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                You don't have any subscriptions yet. <a href="{{ route('frontend.subscription') }}" class="alert-link">Browse our plans</a> to get started.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                @if($activeSubscription)
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4>Current Subscription</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-3">{{ $activeSubscription->plan->name }}</h5>
                            <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                            <p><strong>Price:</strong> ${{ number_format($activeSubscription->plan->price, 2) }}</p>
                            <p><strong>Billing Cycle:</strong> {{ ucfirst($activeSubscription->plan->billing_cycle) }}</p>
                            <p><strong>Expires:</strong>
                                @if($activeSubscription->plan->duration_in_days > 3650)
                                    Lifetime
                                @else
                                    {{ $activeSubscription->end_date->format('M d, Y') }}
                                @endif
                            </p>

                            <div class="mt-3">
                                <a href="{{ route('frontend.subscriptionDetail', $activeSubscription->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4>No Active Subscription</h4>
                        </div>
                        <div class="card-body">
                            <p>You don't have an active subscription at the moment.</p>
                            <div class="mt-3">
                                <a href="{{ route('frontend.subscription') }}" class="btn btn-primary">Browse Plans</a>
                            </div>
                        </div>
                    </div>
                @endif

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
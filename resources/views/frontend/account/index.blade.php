@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">My Account</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="section-padding service-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="acc-left-menu p-4 mb-5 mb-lg-0 mb-md-0">
                        <div class="product-menu">
                            <ul class="list-inline m-0 nav nav-tabs flex-column bg-transparent border-0" role="tablist">
                                <li class="pb-3 nav-item" role="presentation">
                                    <button class="nav-link active p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#dashboard" type="button" role="tab" aria-selected="true"><i
                                            class="fas fa-tachometer-alt"></i><span class="ms-2">Dashboard</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#orders" type="button" role="tab" aria-selected="false"
                                        tabindex="-1"><i class="fas fa-list"></i><span
                                            class="ms-2">Orders</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#subscriptions" type="button" role="tab"
                                        aria-selected="false" tabindex="-1"><i class="fas fa-credit-card"></i><span
                                            class="ms-2">Subscriptions</span></button>
                                </li>
                                <li class="py-3 nav-item" role="presentation">
                                    <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                        data-bs-target="#account-details" type="button" role="tab"
                                        aria-selected="false" tabindex="-1"><i class="fas fa-user"></i><span
                                            class="ms-2">Account details</span></button>
                                </li>
                                <li class="pt-3 nav-item" role="presentation">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="nav-link p-0 bg-transparent" data-bs-toggle="tab"
                                            data-bs-target="#logout" type="submit" role="tab" aria-selected="false"
                                            tabindex="-1"><i class="fas fa-sign-out-alt"></i><span
                                                class="ms-2">Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="product-menu-content">
                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                            <div class="myaccount-content text-body p-4">
                                <p>Hello {{ $user->name }} (not {{ $user->name }}?
                                    <a href="#" onclick="document.getElementById('logout-form').submit();">Log out</a>
                                    )
                                </p>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <p>From your account dashboard you can view your <a href="javascript:void(0)" onclick="document.querySelector('[data-bs-target=\'#orders\']').click()">recent
                                        orders</a>, manage your <a href="javascript:void(0)" onclick="document.querySelector('[data-bs-target=\'#subscriptions\']').click()">subscription</a> and <a
                                        href="javascript:void(0)" onclick="document.querySelector('[data-bs-target=\'#account-details\']').click()">edit your password and account details</a>.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="orders-table text-body p-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th class="fw-bolder p-3">Order</th>
                                                <th class="fw-bolder p-3">Items</th>
                                                <th class="fw-bolder p-3">Date</th>
                                                <th class="fw-bolder p-3">Status</th>
                                                <th class="fw-bolder p-3">Total</th>
                                                <th class="fw-bolder p-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $order)
                                                <tr class="border-bottom">
                                                    <td class="text-primary fs-6">#{{ $order->id }}</td>
                                                    <td>
                                                        <small>
                                                            @foreach($order->items as $item)
                                                                {{ $item->movie->title }}<br>
                                                            @endforeach
                                                        </small>
                                                    </td>
                                                    <td>{{ $order->created_at->format('F d, Y') }}</td>
                                                    <td>
                                                        @if($order->status == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($order->status == 'completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @elseif($order->status == 'cancelled')
                                                            <span class="badge bg-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td>${{ number_format($order->total_amount, 2) }} for {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($order->status == 'pending' && (!$order->paymentDetail || $order->paymentDetail->payment->status == 'pending'))
                                                                <div class="iq-button">
                                                                    <a href="{{ route('frontend.checkout', ['order_id' => $order->id]) }}"
                                                                       class="btn text-uppercase position-relative">
                                                                        <span class="button-text">pay</span>
                                                                        <i class="fa-solid fa-play"></i>
                                                                    </a>
                                                                </div>
                                                            @endif

                                                            <div class="iq-button">
                                                                <a href="{{ route('frontend.orders.show', $order->id) }}"
                                                                   class="btn text-uppercase position-relative">
                                                                    <span class="button-text">view</span>
                                                                    <i class="fa-solid fa-play"></i>
                                                                </a>
                                                            </div>

                                                            @if($order->status == 'pending')
                                                                <div class="iq-button">
                                                                    <a href="#"
                                                                       onclick="event.preventDefault(); document.getElementById('cancel-order-{{ $order->id }}').submit();"
                                                                       class="btn text-uppercase position-relative">
                                                                        <span class="button-text">cancel</span>
                                                                        <i class="fa-solid fa-play"></i>
                                                                    </a>
                                                                </div>
                                                                <form id="cancel-order-{{ $order->id }}"
                                                                      action="{{ route('frontend.orders.cancel', $order->id) }}"
                                                                      method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No orders found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="subscriptions" role="tabpanel">
                            <div class="subscriptions-table text-body p-4">
                                <h4 class="mb-4">Your Subscription History</h4>

                                @if($activeSubscription)
                                    <div class="active-subscription mb-5">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0">Active Subscription</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5>{{ $activeSubscription->plan->name }}</h5>
                                                        <p class="mb-1"><strong>Price:</strong> ${{ number_format($activeSubscription->plan->price, 2) }} / {{ $activeSubscription->plan->billing_cycle }}</p>
                                                        <p class="mb-1"><strong>Status:</strong>
                                                            <span class="badge bg-success">Active</span>
                                                        </p>
                                                        <p class="mb-1"><strong>Started:</strong> {{ $activeSubscription->start_date->format('F d, Y') }}</p>
                                                        <p class="mb-1"><strong>Expires:</strong>
                                                            @if($activeSubscription->plan->duration_in_days > 3650)
                                                                Lifetime
                                                            @else
                                                                {{ $activeSubscription->end_date->format('F d, Y') }}
                                                            @endif
                                                        </p>
                                                        <p class="mb-1"><strong>Auto-renew:</strong> {{ $activeSubscription->auto_renew ? 'Yes' : 'No' }}</p>
                                                    </div>
                                                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                                                        <div class="d-flex gap-2">
                                                            <div class="iq-button">
                                                                <a href="{{ route('frontend.subscriptionDetail', $activeSubscription->id) }}" class="btn text-uppercase position-relative">
                                                                    <span class="button-text">Details</span>
                                                                    <i class="fa-solid fa-play"></i>
                                                                </a>
                                                            </div>
                                                            <div class="iq-button">
                                                                    <button href="#" class="btn text-uppercase position-relative btn-remove"
                                                                        data-id="{{ $activeSubscription->id }}"
                                                                        data-url="{{ route('frontend.cancelSubscription', $activeSubscription->id) }}">
                                                                        <span class="button-text">Cancel</span>
                                                                        <i class="fa-solid fa-play"></i>
                                                                    </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="no-subscription mb-4">
                                        <div class="alert alert-info">
                                            <p class="mb-0">You don't have an active subscription. <a href="{{ route('frontend.subscription') }}" class="alert-link">Browse our subscription plans</a> to subscribe.</p>
                                        </div>
                                    </div>
                                @endif

                                <h5 class="mb-3">Subscription History</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th class="fw-bolder p-3">ID</th>
                                                <th class="fw-bolder p-3">Plan</th>
                                                <th class="fw-bolder p-3">Start Date</th>
                                                <th class="fw-bolder p-3">End Date</th>
                                                <th class="fw-bolder p-3">Status</th>
                                                <th class="fw-bolder p-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($subscriptions as $subscription)
                                                <tr class="border-bottom">
                                                    <td class="text-primary fs-6">#{{ $subscription->id }}</td>
                                                    <td>{{ $subscription->plan->name }}</td>
                                                    <td>{{ $subscription->start_date->format('F d, Y') }}</td>
                                                    <td>
                                                        @if($subscription->plan->duration_in_days > 3650)
                                                            Lifetime
                                                        @else
                                                            {{ $subscription->end_date->format('F d, Y') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($subscription->status == 'active' && $subscription->end_date > now())
                                                            <span class="badge bg-success">Active</span>
                                                        @elseif($subscription->status == 'active' && $subscription->end_date <= now())
                                                            <span class="badge bg-secondary">Expired</span>
                                                        @elseif($subscription->status == 'canceled')
                                                            <span class="badge bg-danger">Canceled</span>
                                                        @else
                                                            <span class="badge bg-info">{{ ucfirst($subscription->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="iq-button">
                                                            <a href="{{ route('frontend.subscriptionDetail', $subscription->id) }}" class="btn text-uppercase position-relative">
                                                                <span class="button-text">Details</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No subscription history found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    <div class="iq-button">
                                        <a href="{{ route('frontend.subscriptionHistory') }}" class="btn text-uppercase position-relative">
                                            <span class="button-text">View Full History</span>
                                            <i class="fa-solid fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-details" role="tabpanel">
                            <div class="p-4 text-body">
                                <form action="{{ route('user.updateFrontend', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <!-- Hidden field to indicate the request is from the frontend -->
                                    <input type="hidden" name="from_frontend" value="1">

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Name&nbsp; <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control" required="required">
                                    </div>
                                    <em class="d-block mb-5">This will be how your name will be displayed in the account
                                        section and in reviews</em>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Email address&nbsp; <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control" required="required">
                                    </div>
                                    <div class="form-group mb-5">
                                        <label class="mb-2">Profile Image</label>
                                        <input type="file" name="user_profile" class="form-control">
                                    </div>
                                    <div id="profile-edit">
                                        <h2>Password Change</h2>
                                        <!-- Your profile edit form here -->
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Current password (leave blank to leave unchanged)</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">New password (leave blank to leave unchanged)</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="mb-2">Confirm new password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <div class="iq-button">
                                            <button type="submit" class="btn text-uppercase position-relative">
                                                <span class="button-text">Save Changes</span>
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="logout" role="tabpanel">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div> --}}

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
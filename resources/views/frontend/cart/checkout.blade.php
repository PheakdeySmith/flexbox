@extends('frontend.layouts.app')

@section('content')

    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">Checkout</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="checkout-page section-padding">
        <div class="container">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 col-md-10">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 col-md-10">
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 col-md-10">
                        <div class="alert alert-info">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
            @endif
            <!-- End Success/Error Messages -->

            <div class="main-cart mb-3 mb-md-5 pb-0 pb-md-5">
                <ul
                    class="cart-page-items d-flex justify-content-center list-inline align-items-center gap-3 gap-md-5 flex-wrap">
                    <li class="cart-page-item">
                        <span class="cart-pre-number border-radius rounded-circle me-1"> 1 </span>
                        <span class="cart-page-link">
                            Shopping Cart </span>
                    </li>
                    <li class="cart-page-item">
                        <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </li>
                    <li class="cart-page-item active">
                        <span class="cart-pre-heading badge cart-pre-number bg-primary border-radius rounded-circle me-1">
                            2 </span>
                        <span class="cart-page-link">
                            Checkout </span>
                    </li>
                    <li class="cart-page-item">
                        <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </li>
                    <li class="cart-page-item">
                        <span class="cart-pre-number border-radius rounded-circle me-1"> 3 </span>
                        <span class="cart-page-link">
                            Order Summary </span>
                    </li>
                </ul>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card bg-dark border">
                        <div class="card-body p-4">
                            <form action="{{ route('frontend.processCheckout') }}" method="POST">
                                @csrf
                                <h5 class="card-title mb-4">Order Summary</h5>

                                <div class="checkout-review-order">
                                    <div class="table-responsive">
                                        <table class="table w-100">
                                            <tbody>
                                                @if (isset($movies) && count($movies) > 0)
                                                    @foreach ($movies as $movie)
                                                        <tr class="cart_item">
                                                            <td class="product-name">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="product-image me-3">
                                                                        <img width="80" height="120"
                                                                            src="{{ $movie['poster'] }}" class="cartimg"
                                                                            alt="{{ $movie['title'] }}" loading="lazy">
                                                                    </div>
                                                                    <div class="text">
                                                                        <span
                                                                            class="fw-500 text-body">{{ $movie['title'] }}</span><br>
                                                                        <strong
                                                                            class="text-white font-size-12 fw-bold">QTY:&nbsp;1</strong>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="product-total text-end">
                                                                <span class="Price-amount"><bdi
                                                                        class="fw-500 text-body"><span>$</span>{{ $movie['price'] }}</bdi></span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2" class="text-center">Your cart is empty</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr class="border-bottom">
                                                    <td class="ps-0 p-3 fw-500 font-size-18">Subtotal</td>
                                                    <td class="pe-0 p-3 fw-500 text-end">
                                                        <span
                                                            class="mb-0 text-body">${{ isset($total) ? $total : '0.00' }}</span>
                                                    </td>
                                                </tr>
                                                <tr class="border-bottom">
                                                    <td class="ps-0 p-3 fw-500 font-size-18">Total</td>
                                                    <td class="pe-0 p-3 fw-500 text-end">
                                                        <span
                                                            class="text-primary mb-0">${{ isset($total) ? $total : '0.00' }}</span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3">
                                    <h5 class="mb-3">Payment Method</h5>
                                    <div class="payment-box border-bottom mb-4 pb-4">
                                        <div class="payment-methods">
                                            <div class="row payment-method-row">
                                                <div class="col-lg-12 mb-4">
                                                    <label class="payment-method-card" id="credit-card-option" style="background-color: rgb(229, 9, 20); color: white;">
                                                        <input type="radio" name="payment_method" value="credit_card"
                                                            class="payment-radio" checked onchange="updatePaymentMethod()">
                                                        <div class="payment-method-content">
                                                            <div class="d-flex align-items-center">
                                                                <div class="payment-icon me-3 credit-card" style="background-color: rgba(255, 255, 255, 0.2);">
                                                                    <i class="fa-solid fa-credit-card"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1" style="color: white;">Credit Card</h5>
                                                                    <p class="mb-0 small" style="color: white;">Pay with your credit card</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <label class="payment-method-card" id="paypal-option">
                                                        <input type="radio" name="payment_method" value="paypal"
                                                            class="payment-radio" onchange="updatePaymentMethod()">
                                                        <div class="payment-method-content">
                                                            <div class="d-flex align-items-center">
                                                                <div class="payment-icon me-3 paypal">
                                                                    <i class="fa-brands fa-paypal"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1">PayPal</h5>
                                                                    <p class="mb-0 small">Pay with your PayPal account</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email" class="mb-2">Email address (for receipt)</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email ?? '' }}" required>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="notes" class="mb-2">Order notes (optional)</label>
                                        <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Notes about your order"></textarea>
                                    </div>

                                    <p class="mt-3 mb-4">
                                        Your personal data will be used to process your order, support your experience
                                        throughout this website, and for other purposes described in our <a
                                            href="{{ route('frontend.home') }}">privacy
                                            policy</a>.
                                    </p>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary text-uppercase">
                                            <span class="button-text">Place Order</span>
                                            <i class="fa-solid fa-play ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function updatePaymentMethod() {
        if ($('input[name="payment_method"]:checked').val() === 'credit_card') {
            // Credit Card is selected
            $('#credit-card-option').css({
                'background-color': 'rgb(229, 9, 20)',
                'color': 'white',
                'border-color': 'rgb(229, 9, 20)'
            });
            $('#credit-card-option .payment-icon').css('background-color', 'rgba(255, 255, 255, 0.2)');
            $('#credit-card-option h5, #credit-card-option p').css('color', 'white');

            // Reset PayPal
            $('#paypal-option').css({
                'background-color': '#2a2a2a',
                'color': 'inherit',
                'border-color': '#444'
            });
            $('#paypal-option .payment-icon').css('background-color', '#1565c0');
            $('#paypal-option h5').css('color', 'inherit');
            $('#paypal-option p').css('color', 'inherit');
        } else {
            // PayPal is selected
            $('#paypal-option').css({
                'background-color': 'rgb(229, 9, 20)',
                'color': 'white',
                'border-color': 'rgb(229, 9, 20)'
            });
            $('#paypal-option .payment-icon').css('background-color', 'rgba(255, 255, 255, 0.2)');
            $('#paypal-option h5, #paypal-option p').css('color', 'white');

            // Reset Credit Card
            $('#credit-card-option').css({
                'background-color': '#2a2a2a',
                'color': 'inherit',
                'border-color': '#444'
            });
            $('#credit-card-option .payment-icon').css('background-color', '#0277bd');
            $('#credit-card-option h5').css('color', 'inherit');
            $('#credit-card-option p').css('color', 'inherit');
        }
    }

    $(document).ready(function() {
        // Set initial state
        updatePaymentMethod();

        // Handle direct clicks on the labels
        $('#credit-card-option').click(function() {
            $('input[name="payment_method"][value="credit_card"]').prop('checked', true);
            updatePaymentMethod();
        });

        $('#paypal-option').click(function() {
            $('input[name="payment_method"][value="paypal"]').prop('checked', true);
            updatePaymentMethod();
        });
    });
</script>
@endpush

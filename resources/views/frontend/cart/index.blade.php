@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">Cart</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!--bread-crumb-->

    <div class="cart-page  section-padding">
        <div class="container">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
            @endif

            @if(session('info'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                </div>
            </div>
            @endif
            <!-- End Success/Error Messages -->

            <!-- Debug information -->
            {{-- <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <h5>Debug Information</h5>
                        <p>Cart Items: {{ isset($movies) ? count($movies) : 0 }}</p>
                        <p>Session Cart: {{ json_encode(session('cart')) }}</p>
                    </div>
                </div>
            </div> --}}
            <!-- End debug information -->

            <div class="main-cart mb-3 mb-md-5 pb-0 pb-md-5">
                <ul
                    class="cart-page-items d-flex justify-content-center list-inline align-items-center gap-3 gap-md-5 flex-wrap">
                    <li class="cart-page-item active">
                        <span class="cart-pre-heading badge cart-pre-number bg-primary border-radius rounded-circle me-1"> 1
                        </span>
                        <span class="cart-page-link ">
                            Shopping Cart </span>
                    </li>
                    <li>
                        <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </li>
                    <li>
                        <span class=" cart-pre-number border-radius rounded-circle me-1">
                            2 </span>
                        <span class="cart-page-link ">
                            Checkout </span>
                    </li>
                    <li>
                        <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </li>
                    <li>
                        <span class=" cart-pre-number border-radius rounded-circle me-1"> 3 </span>
                        <span class="cart-page-link ">
                            Order Summary </span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col" class="font-size-18 fw-500">Product</th>
                                    <th scope="col" class="font-size-18 fw-500">Price</th>
                                    <th scope="col" class="font-size-18 fw-500">Quantity</th>
                                    <th scope="col" class="font-size-18 fw-500">Subtotal</th>
                                    <th scope="col" class="font-size-18 fw-500"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($movies) && count($movies) > 0)
                                    @foreach($movies as $movie)
                                        <tr data-item="list">
                                            <td>
                                                <div class="product-thumbnail d-flex align-items-center gap-3">
                                                    <a class="d-block mb-2" href="{{ route('frontend.detail', $movie['id']) }}">
                                                        <img class="avatar-80" src="{{ $movie['poster'] }}" alt="{{ $movie['title'] }}">
                                                    </a>
                                                    <span class="text-white">{{ $movie['title'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-500">${{ $movie['price'] }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group iq-qty-btn border border-white rounded-0" data-qty="btn"
                                                    role="group">
                                                    <input type="text"
                                                        class="btn btn-sm btn-outline-light input-display border-0"
                                                        data-qty="input" value="1" title="Qty" readonly>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-500">${{ $movie['price'] }}</span>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                   class="btn btn-icon btn-danger delete-btn text-end bg-transparent text-body border-0"
                                                   data-remove-url="{{ route('frontend.removeFromCart', $movie['id']) }}">
                                                    <span class="btn-inner">
                                                        <i class="far fa-trash-alt"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Your cart is empty</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart_totals p-4">
                        <h5 class="mb-3 font-size-18 fw-500">Cart Totals</h5>
                        <div class="css_prefix-woocommerce-cart-box table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th class="border-0"><span class="fw-500">Subtotal</span></th>
                                        <td class="border-0">
                                            <span>${{ isset($total) ? $total : '0.00' }}</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th class="border-0">
                                            <span class="fw-500"> Total </span>
                                        </th>
                                        <td class="border-0">
                                            <span class="fw-500 text-primary">${{ isset($total) ? $total : '0.00' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="button-primary">
                                <div class="iq-button">
                                    <a href="{{ route('frontend.checkout') }}"
                                        class="btn text-uppercase position-relative {{ isset($total) && $total > 0 ? '' : 'disabled' }}">
                                        <span class="button-text">Proceed to checkout</span>
                                        <i class="fa-solid fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

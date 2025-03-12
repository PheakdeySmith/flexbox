@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">Order Tracking</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a
                    href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Order Tracking</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> <!--bread-crumb-->

    <section class="section-padding">
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

        <div class="main-cart mb-3 mb-md-5 pb-0 pb-md-5">
          <ul
            class="cart-page-items d-flex justify-content-center list-inline align-items-center gap-3 gap-md-5 flex-wrap">
            <li class="cart-page-item">
              <span class=" cart-pre-number  border-radius rounded-circle me-1"> 1
              </span>
              <span class="cart-page-link ">
                Shopping Cart </span>
            </li>
            <li class="cart-page-item">
              <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </li>
            <li class="cart-page-item">
              <span class=" cart-pre-number  border-radius rounded-circle me-1"> 2
              </span>
              <span class="cart-page-link ">
                Checkout </span>
            </li>
            <li class="cart-page-item">
              <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </li>
            <li class="cart-page-item active">
              <span class="cart-pre-heading badge bg-primary cart-pre-number border-radius rounded-circle me-1">
                3 </span>
              <span class="cart-page-link ">
                Order Summary </span>
            </li>
          </ul>
        </div>
        <div class="order">
          <p class="thank">Thank you. Your order has been received.</p>
          <ul class="details list-inline">
            <li class="detail">ORDER NUMBER:<strong>{{ $order->id }}</strong></li>
            <li class="detail">DATE:<strong>{{ $order->created_at->format('F d, Y') }}</strong></li>
            <li class="detail">EMAIL:<strong>{{ $order->user->email }}</strong></li>
            <li class="detail">TOTAL:<strong>${{ $order->total_amount }}</strong></li>
            <li class="detail">PAYMENT METHOD:<strong>{{ ucfirst($order->paymentDetail->payment->payment_method ?? 'N/A') }}</strong></li>
          </ul>
        </div>
        <h5 class="order_details">Order Details</h5>
        <div class="row">
          <div class="col-lg-8">
            <section class="maintable">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th class="text-end">Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->items as $item)
                  <tr class="order_item">
                    <td>
                      {{ $item->movie->title }} <strong class="product-quantity">×&nbsp;1</strong>
                    </td>
                    <td class="text-end">
                      <span class="amount"><bdi><span>$</span>{{ $item->price }}</bdi></span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="order_item">
                    <th>Subtotal:</th>
                    <td class="text-end"><span class="amount text-primary"><span>$</span>{{ $order->total_amount }}</span></td>
                  </tr>
                  <tr class="order_item">
                    <th>Payment method:</th>
                    <td class="text-end">{{ ucfirst($order->paymentDetail->payment->payment_method ?? 'N/A') }}</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td class="text-end"><span class="amount text-primary"><span>$</span>{{ $order->total_amount }}</span></td>
                  </tr>
                </tfoot>
              </table>
            </section>
          </div>
          <div class="col-lg-4">
            <div class="bill_section">
              <address>
                <div class="table-responsive bill_table">
                  <table class="table">
                    <thead>
                      <tr>
                        <td>Billing address </td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="label-name">Name</td>
                        <td class="seprator"><span>:</span></td>
                        <td class="last-name">{{ $order->user->name }}</td>
                      </tr>
                      <tr>
                        <td class="label-name">Email</td>
                        <td class="seprator"><span>:</span></td>
                        <td class="last-name">{{ $order->user->email }}</td>
                      </tr>
                      <tr>
                        <td class="label-name">Order Status</td>
                        <td class="seprator"><span>:</span></td>
                        <td class="last-name">{{ ucfirst($order->status) }}</td>
                      </tr>
                      <tr>
                        <td class="label-name">Payment Status</td>
                        <td class="seprator"><span>:</span></td>
                        <td class="last-name">{{ ucfirst($order->paymentDetail->payment->status ?? 'N/A') }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </address>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

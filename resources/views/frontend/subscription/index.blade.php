@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">Pricing Plan</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a
                    href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">Home</a></li>
                <li class="breadcrumb-item active">Pricing Plan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> <!--bread-crumb-->


    <div class="section-padding">
      <div class="container">
        <div class="row">
          @foreach($plans as $plan)
          <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
            <div class="pricing-plan-wrapper">
              <div class="pricing-plan-header">
                <h4 class="plan-name text-capitalize text-body mb-0">{{ $plan->name }}</h4>
                <span class="main-price text-primary">${{ $plan->price }}</span>
                <span class="font-size-18">/ {{ $plan->billing_cycle }}</span>
              </div>
              <div class="pricing-details">
                <div class="pricing-plan-description">
                  <ul class="list-inline p-0">
                    @foreach($plan->features as $feature)
                    <li>
                      <i class="fas fa-check text-primary"></i>
                      <span class="font-size-18 fw-500">{{ $feature }}</span>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <div class="pricing-plan-footer">
                  <div class="iq-button">
                    <a href="{{ route('frontend.subscriptionCheckout', $plan->id) }}" class="btn text-uppercase position-relative">
                      <span class="button-text">select {{ strtolower($plan->name) }}</span>
                      <i class="fa-solid fa-play"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

  </main>

@endsection

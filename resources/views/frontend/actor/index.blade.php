@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">{{ isset($directors) ? 'Directors' : 'Cast' }}</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ isset($directors) ? 'Directors' : 'Cast' }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> <!--bread-crumb-->

    <section class="section-padding">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6">
          @if(isset($directors) && count($directors) > 0)
            @foreach($directors as $director)
              <div class="col">
                <div class="iq-cast">
                  <img src="{{ $director->profile_photo ? $director->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="img-fluid" alt="{{ $director->name }}">
                  <div class="card-img-overlay iq-cast-body">
                    <h6 class="cast-title fw-500">
                      <a href="{{ route('frontend.directorDetail', ['id' => $director->id]) }}">
                        {{ $director->name }}
                      </a>
                    </h6>
                    <span class="cast-subtitle">
                      Director
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
          @elseif(isset($actors) && count($actors) > 0)
            @foreach($actors as $actor)
              <div class="col">
                <div class="iq-cast">
                  <img src="{{ $actor->profile_photo ? $actor->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="img-fluid" alt="{{ $actor->name }}">
                  <div class="card-img-overlay iq-cast-body">
                    <h6 class="cast-title fw-500">
                      <a href="{{ route('frontend.actorDetail', ['id' => $actor->id]) }}">
                        {{ $actor->name }}
                      </a>
                    </h6>
                    <span class="cast-subtitle">
                      Actor
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="col-12">
              <div class="alert alert-info">
                No {{ isset($directors) ? 'directors' : 'actors' }} found.
              </div>
            </div>
          @endif
        </div>
        @if((isset($directors) && count($directors) > 12) || (isset($actors) && count($actors) > 12))
          <div class="text-center">
            <div class="iq-button">
              <a href="javascript:void(0)" class="btn text-uppercase position-relative">
                <span class="button-text">load more</span>
                <i class="fa-solid fa-play"></i>
              </a>
            </div>
          </div>
        @endif
      </div>
    </section>
@endsection

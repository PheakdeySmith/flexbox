@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">Cast</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a
                    href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">Home</a></li>
                <li class="breadcrumb-item active">Cast</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> <!--bread-crumb-->

    <section class="section-padding">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6">
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/01.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Debbi
                    Bossi
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Production
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/02.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Karen
                    Gilchrist
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Production
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/03.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    James
                    Chinlund
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Art
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/04.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Brenda
                    Chapman
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Writing
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/05.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Mark
                    Livolsi
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Editing
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/06.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Caleb
                    Deschannel
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Camera
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/02.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Hans
                    Zimmer
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Sound
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/01.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    John
                    Bartnicki
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Production
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/04.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Jeffrey
                    Silver
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Production
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/05.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Linda
                    Wolverton
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Writing
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/06.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Johnathon
                    Roberts
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Writing
                </span>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="iq-cast">
              <img src="{{ asset('frontend/assets') }}/images/01.webp" class="img-fluid" alt="castImg">
              <div class="card-img-overlay iq-cast-body">
                <h6 class="cast-title fw-500">
                  <a href="https://templates.iqonic.design/streamit-dist/frontend/html/person-detail.html">
                    Irene
                    Mecchi
                  </a>
                </h6>
                <span class="cast-subtitle">
                  Writing
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <div class="iq-button">
            <a href="javascript:void(0)" class="btn text-uppercase position-relative">
              <span class="button-text">load more</span>
              <i class="fa-solid fa-play"></i>
            </a>
          </div>
        </div>
      </div>
    </section>
@endsection

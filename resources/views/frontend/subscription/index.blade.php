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

  <footer class="footer footer-default">
    <div class="container-fluid">
      <div class="footer-top">
        <div class="row">
          <div class="col-xl-3 col-lg-6 mb-5 mb-lg-0">
            <div class="footer-logo">
              <!--Logo -->
              <div class="logo-default">
                <a class="navbar-brand text-primary"
                  href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">
                  <img class="img-fluid logo" src="./pricing_files/logo.webp" loading="lazy" alt="streamit">
                </a>
              </div>
              <div class="logo-hotstar">
                <a class="navbar-brand text-primary"
                  href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">
                  <img class="img-fluid logo" src="./pricing_files/logo-hotstar.webp" loading="lazy" alt="streamit">
                </a>
              </div>
              <div class="logo-prime">
                <a class="navbar-brand text-primary"
                  href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">
                  <img class="img-fluid logo" src="./pricing_files/logo-prime.webp" loading="lazy" alt="streamit">
                </a>
              </div>
              <div class="logo-hulu">
                <a class="navbar-brand text-primary"
                  href="https://templates.iqonic.design/streamit-dist/frontend/html/index.html">
                  <img class="img-fluid logo" src="./pricing_files/logo-hulu.webp" loading="lazy" alt="streamit">
                </a>
              </div>
            </div>
            <p class="mb-4 font-size-14">Email us: <span class="text-white">customer@streamit.com</span>
            </p>
            <p class="text-uppercase letter-spacing-1 font-size-14 mb-1">customer services</p>
            <p class="mb-0 contact text-white">+ (480) 555-0103</p>
          </div>
          <div class="col-xl-2 col-lg-6 mb-5 mb-lg-0">
            <h4 class="footer-link-title">Quick Links</h4>
            <ul class="list-unstyled footer-menu">
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/about-us.html" class="ms-3">about
                  us</a>
              </li>
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/blog/blog-listing.html"
                  class="ms-3">Blog</a>
              </li>
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/pricing-plan.html"
                  class="ms-3">Pricing Plan</a>
              </li>
              <li>
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/faq.html" class="ms-3">FAQ</a>
              </li>
            </ul>
          </div>
          <div class="col-xl-2 col-lg-6 mb-5 mb-lg-0">
            <h4 class="footer-link-title">Movies to watch</h4>
            <ul class="list-unstyled footer-menu">
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                  class="ms-3">Top trending</a>
              </li>
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                  class="ms-3">Recommended</a>
              </li>
              <li>
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html"
                  class="ms-3">Popular</a>
              </li>
            </ul>
          </div>
          <div class="col-xl-2 col-lg-6 mb-5 mb-lg-0">
            <h4 class="footer-link-title">About company</h4>
            <ul class="list-unstyled footer-menu">
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/contact-us.html"
                  class="ms-3">contact us</a>
              </li>
              <li class="mb-3">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/privacy-policy.html"
                  class="ms-3">privacy policy</a>
              </li>
              <li>
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/terms-of-use.html"
                  class="ms-3">Terms of use</a>
              </li>
            </ul>
          </div>
          <div class="col-xl-3 col-lg-6">
            <h4 class="footer-link-title">Subscribe Newsletter</h4>
            <div class="mailchimp mailchimp-dark">
              <div class="input-group mb-3 mt-4">
                <input type="text" class="form-control mb-0 font-size-14" placeholder="Email*"
                  aria-describedby="button-addon2" data-sharkid="__0" data-sharklabel="email">
                <div class="iq-button">
                  <button type="submit" class="btn btn-sm" id="button-addon2">Subscribe</button>
                </div>
                <shark-icon-container data-sharkidcontainer="__0"><template shadowrootmode="open"><surfhark-icon
                      data-sharkidicon="__0"
                      style="background-image: url(&quot;chrome-extension://ailoabdmgclmfmhdagmlohpjlbpffblp/autofill-action-dark.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: cover; position: absolute; right: 0px; visibility: visible; display: block; z-index: 1; border: none; cursor: pointer; padding: 0px; transition: none; pointer-events: all; opacity: 1; left: 167.063px; top: 14.8px; width: 18px; height: 18px; min-width: 18px; min-height: 18px;"></surfhark-icon></template></shark-icon-container>
              </div>
            </div>
            <div class="d-flex align-items-center mt-5">
              <span class="font-size-14 me-2">Follow Us:</span>
              <ul class="p-0 m-0 list-unstyled widget_social_media">
                <li>
                  <a href="https://www.facebook.com/" class="position-relative">
                    <i class="fab fa-facebook"></i>
                  </a>
                </li>
                <li>
                  <a href="https://twitter.com/" class="position-relative">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li>
                  <a href="https://github.com/" class="position-relative">
                    <i class="fab fa-github"></i>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/" class="position-relative">
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom border-top">
        <div class="row align-items-center">
          <div class="col-md-6">
            <ul class="menu list-inline p-0 d-flex flex-wrap align-items-center">
              <li class="menu-item">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/pricing-plan.html#"> Terms Of Use
                </a>
              </li>
              <li id="menu-item-7316" class="menu-item">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/privacy-policy.html">
                  Privacy-Policy </a>
              </li>
              <li class="menu-item">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/faq.html"> FAQ </a>
              </li>
              <li class="menu-item">
                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/playlist.html"> Watch List </a>
              </li>
            </ul>
            <p class="font-size-14">© <span class="currentYear">2025</span> <span class="text-primary">STREAMIT</span>.
              All Rights Reserved. All videos and shows on this platform are trademarks of, and all related images and
              content are the property of, Streamit Inc. Duplication and copy of this is strictly prohibited.</p>
          </div>
          <div class="col-md-3"></div>
          <div class="col-md-3">
            <h6 class="font-size-14 pb-1">Download Streamit Apps </h6>
            <div class="d-flex align-items-center">
              <a class="app-image"
                href="https://templates.iqonic.design/streamit-dist/frontend/html/pricing-plan.html#">
                <img src="./pricing_files/google-play.webp" loading="lazy" alt="play-store">
              </a>
              <br>
              <a class="ms-3 app-image"
                href="https://templates.iqonic.design/streamit-dist/frontend/html/pricing-plan.html#">
                <img src="./pricing_files/apple.webp" loading="lazy" alt="app-store">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div class="rtl-box">
    <a class="btn btn-icon btn-setting" id="settingbutton" data-bs-toggle="offcanvas" data-bs-target="#live-customizer"
      role="button" aria-controls="live-customizer">
      <svg xmlns="http://www.w3.org/2000/svg" width="1.875em" height="1.875em" viewBox="0 0 20 20" fill="white">
        <path fill-rule="evenodd"
          d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
          clip-rule="evenodd"></path>
      </svg>
    </a>
    <div class="offcanvas offcanvas-end live-customizer on-rtl end" tabindex="-1" id="live-customizer"
      data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="live-customizer-label" aria-modal="true"
      role="dialog">
      <div class="offcanvas-header gap-3">
        <div class="d-flex align-items-center">
          <h5 class="offcanvas-title text-dark" id="live-customizer-label">Live Customizer</h5>
        </div>
        <div class="d-flex gap-1 align-items-center">
          <button class="btn btn-icon text-primary" data-reset="settings" data-bs-toggle="tooltip"
            data-bs-placement="left" aria-label="Reset All Settings" data-bs-original-title="Reset All Settings">
            <span class="btn-inner">
              <i class="fa-solid fa-arrows-rotate"></i>
            </span>
          </button>
          <button type="button" class="btn btn-icon btn-close px-0 text-reset shadow-none text-dark"
            data-bs-dismiss="offcanvas" aria-label="Close">
          </button>
        </div>
      </div>
      <div class="offcanvas-body pt-0">
        <div class="modes row row-cols-2 gx-2">
          <div class="col">
            <div data-setting="attribute" class="text-center w-100">
              <input type="radio" value="ltr" class="btn-check" name="theme_scheme_direction" data-prop="dir"
                id="theme-scheme-direction-ltr" checked="">
              <label class="btn dir-btn cutomizer-button w-100" for="theme-scheme-direction-ltr">
                LTR
              </label>
            </div>
          </div>
          <div class="col">
            <div data-setting="attribute" class="text-center w-100">
              <input type="radio" value="rtl" class="btn-check" name="theme_scheme_direction" data-prop="dir"
                id="theme-scheme-direction-rtl">
              <label class="btn dir-btn cutomizer-button w-100" for="theme-scheme-direction-rtl">
                RTL
              </label>
            </div>
          </div>
        </div>
        <div class="modes mt-3">
          <div class="color-customizer mb-3">
            <h6 class="mb-0 title-customizer">Color Customizer</h6>
          </div>
          <div class="row row-cols-2 gx-2">
            <div class="col mb-3">
              <div data-setting="attribute" class="text-center w-100">
                <input type="radio" value="dark" class="btn-check" name="theme_style_appearance"
                  data-prop="data-bs-theme" id="theme-scheme-color-netflix"
                  data-colors="{&quot;primary&quot;: &quot;#e50914&quot;, &quot;secondary&quot;: &quot;#adafb8&quot;, &quot;tertiray&quot;: &quot;#adafb8&quot;}"
                  checked="">
                <label class="btn dir-btn cutomizer-button w-100" for="theme-scheme-color-netflix">
                  Netflix
                </label>
              </div>
            </div>
            <div class="col mb-3">
              <div data-setting="attribute" class="text-center w-100">
                <input type="radio" value="hotstar" class="btn-check" name="theme_style_appearance"
                  data-prop="data-bs-theme" id="theme-scheme-color-hotstar"
                  data-colors="{&quot;primary&quot;: &quot;#0959E4&quot;, &quot;secondary&quot;: &quot;#adafb8&quot;, &quot;tertiray&quot;: &quot;#EA4335&quot;}">
                <label class="btn dir-btn cutomizer-button w-100" for="theme-scheme-color-hotstar">
                  Hotstar
                </label>
              </div>
            </div>
            <div class="col">
              <div data-setting="attribute" class="text-center w-100">
                <input type="radio" value="amazonprime" class="btn-check" name="theme_style_appearance"
                  data-prop="data-bs-theme" id="theme-scheme-color-prime"
                  data-colors="{&quot;primary&quot;: &quot;#1A98FF&quot;, &quot;secondary&quot;: &quot;#adafb8&quot;, &quot;tertiray&quot;: &quot;#89F425&quot;}">
                <label class="btn dir-btn cutomizer-button w-100" for="theme-scheme-color-prime">
                  Prime
                </label>
              </div>
            </div>
            <div class="col">
              <div data-setting="attribute" class="text-center w-100">
                <input type="radio" value="hulu" class="btn-check" name="theme_style_appearance"
                  data-prop="data-bs-theme" id="theme-scheme-color-hulu"
                  data-colors="{&quot;primary&quot;: &quot;#3ee783&quot;, &quot;secondary&quot;: &quot;#adafb8&quot;, &quot;tertiray&quot;: &quot;#0E0E0E&quot;}">
                <label class="btn dir-btn cutomizer-button w-100" for="theme-scheme-color-hulu">
                  Hulu
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

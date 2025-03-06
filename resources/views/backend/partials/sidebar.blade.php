<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-transparent"
    id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center justify-content-center">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center"
            href="{{ route('backend.dashboard') }}">
            <div style="width: 120px; height: 120px; overflow: hidden; margin: 0 auto;">
                <img src="{{ asset('backend/assets') }}/image/favicon.png"
                    alt="main_logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples"
                    class="nav-link active" aria-controls="dashboardsExamples"
                    role="button" aria-expanded="true">
                    <div
                        class="icon icon-sm shadow-sm border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2">
                        <i class="ni ni-tv-2" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboards</span>
                </a>
                <div class="collapse show" id="dashboardsExamples">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item {{ Request::routeIs('backend.dashboard') ? 'active' : '' }}">
                            <a class="nav-link {{ Request::routeIs('backend.dashboard') ? 'active' : '' }}"
                                href="{{ route('backend.dashboard') }}">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal"> Default </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Authentication</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#authExamples" class="nav-link" aria-controls="authExamples" role="button" aria-expanded="false">
                    <div class="icon icon-sm shadow-sm border-radius-md bg-white text-center d-flex align-items-center justify-content-center me-2">
                        <i class="ni ni-single-copy-04" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Authentication</span>
                </a>
                <div class="collapse" id="authExamples">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('backend.login') ? 'active' : '' }}"
                               href="{{ route('backend.login') }}">
                                <span class="sidenav-mini-icon">L</span>
                                <span class="sidenav-normal">Login</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('backend.register') ? 'active' : '' }}"
                               href="{{ route('backend.register') }}">
                                <span class="sidenav-mini-icon">S</span>
                                <span class="sidenav-normal">Sign Up</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>

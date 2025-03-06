<div class="fixed-plugin ps">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg blur">
        <div class="card-header pb-0 pt-3  bg-transparent ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">UI Configurator</h5>
                <p>Dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-primary active" data-color="primary"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger"
                        onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn btn-primary w-100 px-3 mb-2 active" data-class="bg-transparent"
                    onclick="sidebarType(this)">Transparent</button>
                <button class="btn btn-primary w-100 px-3 mb-2 ms-2" data-class="bg-white"
                    onclick="sidebarType(this)">White</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3">
                <h6 class="mb-0">Navbar Fixed</h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                    onclick="navbarFixed(this)" checked="true" data-sharkid="__1">
            </div>
            <hr class="horizontal dark mb-1 d-xl-block d-none">
            <div class="mt-2 d-xl-block d-none">
                <h6 class="mb-0">Sidenav Mini</h6>
            </div>
            <div class="form-check form-switch ps-0 d-xl-block d-none">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarMinimize"
                    onclick="navbarMinimize(this)" data-sharkid="__2">
            </div>
            <hr class="horizontal dark mb-1 d-xl-block d-none">
            <div class="mt-2 d-xl-block d-none">
                <h6 class="mb-0">Light/Dark</h6>
            </div>
            <div class="form-check form-switch ps-0 d-xl-block d-none">
                {{-- <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)"
                    data-sharkid="__3"> --}}
            </div>
            <hr class="horizontal dark my-sm-4">
            <div class="w-100 text-center">
                <span><template shadowrootmode="closed">
                        <style type="text/css">
                            body {
                                margin: 0
                            }

                            a {
                                text-decoration: none;
                                outline: 0
                            }

                            .widget {
                                display: inline-block;
                                overflow: hidden;
                                font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif;
                                font-size: 0;
                                line-height: 0;
                                white-space: nowrap
                            }

                            .btn,
                            .social-count {
                                position: relative;
                                display: inline-block;
                                display: inline-flex;
                                height: 14px;
                                padding: 2px 5px;
                                font-size: 11px;
                                font-weight: 600;
                                line-height: 14px;
                                vertical-align: bottom;
                                cursor: pointer;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                -ms-user-select: none;
                                user-select: none;
                                background-repeat: repeat-x;
                                background-position: -1px -1px;
                                background-size: 110% 110%;
                                border: 1px solid
                            }

                            .btn {
                                border-radius: .25em
                            }

                            .btn:not(:last-child) {
                                border-radius: .25em 0 0 .25em
                            }

                            .social-count {
                                border-left: 0;
                                border-radius: 0 .25em .25em 0
                            }

                            .widget-lg .btn,
                            .widget-lg .social-count {
                                height: 16px;
                                padding: 5px 10px;
                                font-size: 12px;
                                line-height: 16px
                            }

                            .octicon {
                                display: inline-block;
                                vertical-align: text-top;
                                fill: currentColor;
                                overflow: visible
                            }

                            .btn:focus-visible,
                            .social-count:focus-visible {
                                outline: 2px solid #0969da;
                                outline-offset: -2px
                            }

                            .btn {
                                color: #25292e;
                                background-color: #ebf0f4;
                                border-color: #d1d9e0;
                                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg'%3e%3clinearGradient id='o' x2='0' y2='1'%3e%3cstop stop-color='%23f6f8fa'/%3e%3cstop offset='90%25' stop-color='%23ebf0f4'/%3e%3c/linearGradient%3e%3crect width='100%25' height='100%25' fill='url(%23o)'/%3e%3c/svg%3e");
                                background-image: -moz-linear-gradient(top, #f6f8fa, #ebf0f4 90%);
                                background-image: linear-gradient(180deg, #f6f8fa, #ebf0f4 90%);
                                filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#FFF6F8FA', endColorstr='#FFEAEFF3')
                            }

                            :root .btn {
                                filter: none
                            }

                            .btn:hover,
                            .btn:focus {
                                background-color: #e5eaee;
                                background-position: 0 -0.5em;
                                border-color: #d1d9e0;
                                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg'%3e%3clinearGradient id='o' x2='0' y2='1'%3e%3cstop stop-color='%23eff2f5'/%3e%3cstop offset='90%25' stop-color='%23e5eaee'/%3e%3c/linearGradient%3e%3crect width='100%25' height='100%25' fill='url(%23o)'/%3e%3c/svg%3e");
                                background-image: -moz-linear-gradient(top, #eff2f5, #e5eaee 90%);
                                background-image: linear-gradient(180deg, #eff2f5, #e5eaee 90%);
                                filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#FFEFF2F5', endColorstr='#FFE4E9ED')
                            }

                            :root .btn:hover,
                            :root .btn:focus {
                                filter: none
                            }

                            .btn:active {
                                background-color: #e6eaef;
                                border-color: #d1d9e0;
                                background-image: none;
                                filter: none
                            }

                            .social-count {
                                color: #25292e;
                                background-color: #fff;
                                border-color: #d1d9e0
                            }

                            .social-count:hover,
                            .social-count:focus {
                                color: #0969da
                            }

                            .octicon-heart {
                                color: #bf3989
                            }
                        </style>
            </div>
        </div>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</div>

@extends('backend.layouts.auth')
@section('content')
    <main class="main-content main-content-bg mt-0 ps">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-sm-8 mt-7 mt-md-5">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-primary text-gradient">Join us today</h3>
                                    <p class="mb-0">Enter your email and password to register</p>
                                </div>
                                <div class="card-body pb-3">
                                    <form role="form">
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                                data-sharkid="__0">
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email"
                                                aria-label="Email" data-sharkid="__1" data-sharklabel="email">
                                            <shark-icon-container data-sharkidcontainer="__1"><template
                                                    shadowrootmode="open">
                                                    <surfhark-icon data-sharkidicon="__1"
                                                        style="background-image: url(&quot;chrome-extension://ailoabdmgclmfmhdagmlohpjlbpffblp/autofill-action-light.svg&quot;); background-repeat: no-repeat; background-position: left center; background-size: cover; position: absolute; right: 0px; visibility: visible; display: block; z-index: 1; border: none; cursor: pointer; padding: 0px; transition: none; pointer-events: all; opacity: 1; left: 354.188px; top: 254.25px; width: 18px; height: 18px; min-width: 18px; min-height: 18px;">
                                                    </surfhark-icon>
                                                </template></shark-icon-container>
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Password"
                                                aria-label="Password" data-sharkid="__2">
                                        </div>
                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" checked="" data-sharkid="__3">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="" class="text-dark font-weight-bolder">Terms and
                                                    Conditions</a>
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary w-100 mt-4 mb-0">Sign
                                                up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-sm-4 px-1">
                                    <p class="mb-4 mx-auto">
                                        Already have an account?
                                        <a href="{{ route('backend.login') }}"
                                            class="text-primary text-gradient font-weight-bold">Sign in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url(&#39;{{ asset('backend/assets') }}/image/curved11.jpg&#39;)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </main>
@endsection

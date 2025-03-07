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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form role="form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" aria-label="Name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                                aria-label="Email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                                aria-label="Password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label>Confirm Password</label>
                                        <div class="mb-3">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                                                aria-label="Confirm Password" required autocomplete="new-password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Sign
                                                up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-sm-4 px-1">
                                    <p class="mb-4 mx-auto">
                                        Already have an account?
                                        <a href="{{ route('login') }}"
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

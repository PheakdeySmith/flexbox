@extends('authetication.layouts.app')

@section('content')
<div class="col-lg-8 col-md-12 align-self-center">
<div class="user-login-card bg-body">
    <h4 class="text-center mb-5">Create Your Account</h4>
    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-5">
          <div class="col">
            <label class="text-white fw-500 mb-2">Name *</label>
            <input type="text" name="name" class="form-control rounded-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col">
            <label class="text-white fw-500 mb-2">Email *</label>
            <input type="email" name="email" class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col">
            <label class="text-white fw-500 mb-2">Password *</label>
            <input type="password" name="password" class="form-control rounded-0 @error('password') is-invalid @enderror" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col">
            <label class="text-white fw-500 mb-2">Confirm Password *</label>
            <input type="password" name="password_confirmation" class="form-control rounded-0" required>
          </div>
        </div>
        <div class="row text-center mt-5">
          <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="full-button">
              <div class="iq-button">
                <button type="submit" class="btn text-uppercase position-relative">
                  <span class="button-text">Sign Up</span>
                  <i class="fa-solid fa-play"></i>
                </button>
              </div>
              <p class="mt-2 mb-0 fw-normal">Already have an account?<a
                  href="{{ route('login') }}"
                  class="ms-1">Login</a></p>
            </div>
          </div>
          <div class="col-lg-3"></div>
        </div>
    </form>
  </div>
</div>
@endsection

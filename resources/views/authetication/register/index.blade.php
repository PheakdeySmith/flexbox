@extends('authetication.layouts.app')

@section('content')
<div class="col-lg-8 col-md-12 align-self-center">
<div class="user-login-card bg-body">
    <h4 class="text-center mb-5">Create Your Account</h4>
    <div class="row row-cols-1 row-cols-lg-2 g-2 g-lg-5">
      <div class="col">
        <label class="text-white fw-500 mb-2">First Name</label>
        <input type="text" class="form-control rounded-0" required="">
      </div>
      <div class="col">
        <label class="text-white fw-500 mb-2">Last Name</label>
        <input type="text" class="form-control rounded-0" required="">
      </div>
      <div class="col">
        <label class="text-white fw-500 mb-2">Username *</label>
        <input type="text" class="form-control rounded-0" required="">
      </div>
      <div class="col">
        <label class="text-white fw-500 mb-2">Email *</label>
        <input type="email" class="form-control rounded-0" required="">
      </div>
      <div class="col">
        <label class="text-white fw-500 mb-2">Password *</label>
        <input type="password" class="form-control rounded-0" required="">
      </div>
      <div class="col">
        <label class="text-white fw-500 mb-2">Confirm Password *</label>
        <input type="password" class="form-control rounded-0" required="">
      </div>
    </div>
    <label class="list-group-item d-flex align-items-center mt-5 mb-3 text-white"><input
        class="form-check-input m-0 me-2" type="checkbox">I've read and accept the <a
        href="https://templates.iqonic.design/streamit-dist/frontend/html/terms-of-use.html"
        class="ms-1">terms &amp; conditions*</a></label>
    <div class="row text-center">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <div class="full-button">
          <div class="iq-button">
            <a href="https://templates.iqonic.design/streamit-dist/frontend/html/register.html#"
              class="btn text-uppercase position-relative">
              <span class="button-text">Sign Up</span>
              <i class="fa-solid fa-play"></i>
            </a>
          </div>
          <p class="mt-2 mb-0 fw-normal">Already have an account?<a
              href="{{ route('frontend.login') }}"
              class="ms-1">Login</a></p>
        </div>
      </div>
      <div class="col-lg-3"></div>
    </div>
  </div>
</div>
@endsection

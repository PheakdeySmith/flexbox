<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('backend.dashboard') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('frontend.home') }}" class="nav-link">Frontend</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <!-- User Profile Dropdown Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          @if(Auth::user()->profile_photo)
            <img src="{{ Auth::user()->profile_photo }}" class="user-image img-circle elevation-2" alt="User Image">
          @else
            <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
          @endif
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            @if(Auth::user()->profile_photo)
              <img src="{{ Auth::user()->profile_photo }}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
              {{ Auth::user()->name }}
              <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer d-flex justify-content-between">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-flat mr-5 ml-1">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="float-right">
              @csrf
              <button type="submit" class="btn btn-default btn-flat ml-5">Sign out</button>
            </form>
          </li>
        </ul>
      </li>

    </ul>
  </nav>

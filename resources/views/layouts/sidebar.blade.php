<!-- Sidebar Navigation -->
<div class="sidebar-wrapper" id="sidebar-wrapper">
  <div class="sidebar-logo">
    <a href="{{ route('frontend.home') }}" class="logo">
      <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="logo">
    </a>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-menu-items">
      <li class="sidebar-menu-item {{ Route::is('frontend.home') ? 'active' : '' }}">
        <a href="{{ route('frontend.home') }}" class="sidebar-link">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>

      <li class="sidebar-menu-item {{ Route::is('frontend.movie') ? 'active' : '' }}">
        <a href="{{ route('frontend.movie') }}" class="sidebar-link">
          <i class="fa fa-film"></i>
          <span>Movies</span>
        </a>
      </li>

      <li class="sidebar-menu-item {{ Route::is('frontend.tvSerie') ? 'active' : '' }}">
        <a href="{{ route('frontend.tvSerie') }}" class="sidebar-link">
          <i class="fa fa-tv"></i>
          <span>TV Series</span>
        </a>
      </li>

      <li class="sidebar-menu-item {{ Route::is('frontend.genre') ? 'active' : '' }}">
        <a href="{{ route('frontend.genre') }}" class="sidebar-link">
          <i class="fa fa-tags"></i>
          <span>Genres</span>
        </a>
      </li>

      <li class="sidebar-menu-item {{ Route::is('frontend.actor') ? 'active' : '' }}">
        <a href="{{ route('frontend.actor') }}" class="sidebar-link">
          <i class="fa fa-user"></i>
          <span>Actors</span>
        </a>
      </li>

      @auth
        <li class="sidebar-menu-item {{ Route::is('frontend.watchlist') ? 'active' : '' }}">
          <a href="{{ route('frontend.watchlist') }}" class="sidebar-link">
            <i class="fa fa-bookmark"></i>
            <span>Watchlist</span>
          </a>
        </li>

        <li class="sidebar-menu-item {{ Route::is('frontend.subscription') ? 'active' : '' }}">
          <a href="{{ route('frontend.subscription') }}" class="sidebar-link">
            <i class="fa fa-credit-card"></i>
            <span>Subscription</span>
          </a>
        </li>

        <li class="sidebar-menu-item {{ Route::is('frontend.orders.*') ? 'active' : '' }}">
          <a href="{{ route('frontend.orders.history') }}" class="sidebar-link">
            <i class="fa fa-shopping-cart"></i>
            <span>Orders History</span>
          </a>
        </li>

        <li class="sidebar-menu-item {{ Route::is('profile.edit') ? 'active' : '' }}">
          <a href="{{ route('profile.edit') }}" class="sidebar-link">
            <i class="fa fa-user-circle"></i>
            <span>Profile</span>
          </a>
        </li>

        @if(auth()->user()->hasRole('admin'))
          <li class="sidebar-menu-item {{ Route::is('backend.*') ? 'active' : '' }}">
            <a href="{{ route('backend.dashboard') }}" class="sidebar-link">
              <i class="fa fa-tachometer-alt"></i>
              <span>Admin Dashboard</span>
            </a>
          </li>
        @endif

        <li class="sidebar-menu-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="sidebar-link"
               onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="fa fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
          </form>
        </li>
      @else
        <li class="sidebar-menu-item {{ Route::is('login') ? 'active' : '' }}">
          <a href="{{ route('login') }}" class="sidebar-link">
            <i class="fa fa-sign-in-alt"></i>
            <span>Login</span>
          </a>
        </li>

        <li class="sidebar-menu-item {{ Route::is('register') ? 'active' : '' }}">
          <a href="{{ route('register') }}" class="sidebar-link">
            <i class="fa fa-user-plus"></i>
            <span>Register</span>
          </a>
        </li>
      @endauth
    </ul>
  </div>
</div>

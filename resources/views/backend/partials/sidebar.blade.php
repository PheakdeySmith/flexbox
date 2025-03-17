<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::user()->profile_photo)
              <img src="{{ Auth::user()->profile_photo }}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item {{ Route::is('backend.dashboard') || Route::is('payment.dashboard') ? 'menu-open' : '' }}">
                    <a href="{{ route('backend.dashboard') }}" class="nav-link {{ Route::is('backend.dashboard') || Route::is('payment.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.dashboard') }}" class="nav-link {{ Route::is('backend.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('payment.dashboard') }}" class="nav-link {{ Route::is('payment.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payments</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ Route::is('user.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                                <i class="fas fa-table nav-icon"></i>
                                <!-- Use an appropriate icon for the user table -->
                                <p>User Table</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item {{ Route::is('movie.*') || Route::is('genre.*') || Route::is('actor.*') || Route::is('director.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('movie.*') || Route::is('genre.*') || Route::is('actor.*') || Route::is('director.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Manage Movies
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('movie.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('movie.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Movies
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('movie.index') }}" class="nav-link {{ Route::is('movie.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Movies Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ Route::is('genre.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('genre.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Genre
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('genre.index') }}" class="nav-link {{ Route::is('genre.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Genre Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('actor.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('actor.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Actor
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('actor.index') }}" class="nav-link {{ Route::is('actor.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Actor Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('director.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('director.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Director
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('director.index') }}" class="nav-link {{ Route::is('director.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Director Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ Route::is('watchlist.*') || Route::is('playlist.*') || Route::is('favorite.*') || Route::is('review.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('watchlist.*') || Route::is('playlist.*') || Route::is('favorite.*') || Route::is('review.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Manage Lists
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item {{ Route::is('watchlist.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('watchlist.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>
                                    Watchlist
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('watchlist.index') }}" class="nav-link {{ Route::is('watchlist.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Watchlist Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('playlist.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('playlist.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i> <!-- Playlist icon -->
                                <p>
                                    Playlist
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('playlist.index') }}" class="nav-link {{ Route::is('playlist.index') ? 'active' : '' }}">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <!-- Changed to fa-list-alt for playlist table -->
                                        <p>Playlist Table</p>
                                    </a>

                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('favorite.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('favorite.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-heart"></i> <!-- Changed to heart icon for Favorite -->
                                <p>
                                    Favorite
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('favorite.index') }}" class="nav-link {{ Route::is('favorite.index') ? 'active' : '' }}">
                                        <i class="far fa-heart nav-icon"></i> <!-- Changed to heart outline icon for Favorite Table -->
                                        <p>Favorite Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-item {{ Route::is('review.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('review.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Reviews
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('review.index') }}" class="nav-link {{ Route::is('review.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reviews Table</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('subscription-plan.*') || Route::is('subscription.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('subscription-plan.*') || Route::is('subscription.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Subscriptions
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('subscription-plan.index') }}" class="nav-link {{ Route::is('subscription-plan.index') ? 'active' : '' }}">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>Subscription Plans</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('subscription.index') }}" class="nav-link {{ Route::is('subscription.index') ? 'active' : '' }}">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>Subscriptions</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ Route::is('payment.*') || Route::is('order.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('payment.*') || Route::is('order.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Payments & Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('payment.index') }}" class="nav-link {{ Route::is('payment.index') ? 'active' : '' }}">
                                <i class="fas fa-credit-card nav-icon"></i>
                                <p>All Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link {{ Route::is('order.index') ? 'active' : '' }}">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('reports.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('reports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}" class="nav-link {{ Route::is('reports.index') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt nav-icon"></i>
                                <p>Reports Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.movie-revenue') }}" class="nav-link {{ Route::is('reports.movie-revenue') ? 'active' : '' }}">
                                <i class="fas fa-dollar-sign nav-icon"></i>
                                <p>Movie Revenue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.subscription-analytics') }}" class="nav-link {{ Route::is('reports.subscription-analytics') ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Subscription Analytics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.user-activity') }}" class="nav-link {{ Route::is('reports.user-activity') ? 'active' : '' }}">
                                <i class="fas fa-user-clock nav-icon"></i>
                                <p>User Activity</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.content-performance') }}" class="nav-link {{ Route::is('reports.content-performance') ? 'active' : '' }}">
                                <i class="fas fa-film nav-icon"></i>
                                <p>Content Performance</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@extends('backend.layouts.app')

@section('title', 'User Activity Report')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .card-stats {
        transition: all 0.3s ease;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .card-stats .icon {
        font-size: 30px;
        line-height: 1;
    }

    .stats-number {
        font-size: 24px;
        font-weight: 700;
    }

    .stats-title {
        font-size: 14px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }

    .table th {
        background-color: #f8f9fa;
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        color: #495057;
    }

    .table td {
        vertical-align: middle;
    }

    .section-title {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: #007bff;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #495057;
        font-weight: 500;
        padding: 10px 15px;
    }

    .nav-tabs .nav-link.active {
        color: #007bff;
        background: transparent;
        border-bottom: 3px solid #007bff;
    }

    .date-filter-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .btn-print {
        background-color: #6c757d;
        color: white;
        border-radius: 4px;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }

    .btn-print:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    .table td, .table th {
        padding: 0.3rem 0.5rem;
        font-size: 0.8rem;
    }

    td h6.mb-0 {
        font-size: 0.8rem;
        font-weight: 500;
    }

    .table {
        font-size: 0.8rem;
    }

    .btn-sm {
        padding: 0.15rem 0.3rem;
        font-size: 0.7rem;
    }

    .progress {
        height: 6px !important;
    }

    .badge-pill {
        font-size: 0.75rem;
        padding: 0.25em 0.6em;
    }

    .user-avatar {
        width: 30px;
        height: 30px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">User Activity Report</h1>
                <a href="{{ route('reports.print.user-activity', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}"
                   class="btn btn-print" target="_blank">
                    <i class="fas fa-print mr-1"></i> Print Report
                </a>
            </div>

            <!-- Date Filter -->
            <div class="row">
                <div class="col-12">
                    <div class="date-filter-card">
                        <form action="{{ route('reports.user-activity') }}" method="GET" class="form-inline">
                            <div class="form-group mb-2 mr-sm-2">
                                <label class="mr-2"><i class="far fa-calendar-alt mr-1"></i> Date Range:</label>
                                <input type="text" id="daterange" name="daterange" class="form-control form-control-sm"
                                       value="{{ $startDate->format('m/d/Y') }} - {{ $endDate->format('m/d/Y') }}" />
                                <input type="hidden" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}">
                                <input type="hidden" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mb-2">Apply</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stats bg-gradient-primary text-white h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="stats-title text-white-50">Active Users</div>
                                    <div class="stats-number">{{ $activeUsers }}</div>
                                    <div class="text-white-50">Users with activity</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon text-white-50">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stats bg-gradient-success text-white h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="stats-title text-white-50">Watchlist Adds</div>
                                    <div class="stats-number">{{ $totalWatchlistAdds }}</div>
                                    <div class="text-white-50">Movies added to watchlists</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon text-white-50">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stats bg-gradient-danger text-white h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="stats-title text-white-50">Favorites</div>
                                    <div class="stats-number">{{ $totalFavorites }}</div>
                                    <div class="text-white-50">Movies favorited</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon text-white-50">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stats bg-gradient-warning text-white h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="stats-title text-white-50">Purchases</div>
                                    <div class="stats-number">{{ $totalPurchases }}</div>
                                    <div class="text-white-50">Movies purchased</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon text-white-50">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Activity Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User Activity Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="5%">Avatar</th>
                                            <th width="20%">User</th>
                                            <th width="15%">Joined Date</th>
                                            <th width="12%">Watchlist</th>
                                            <th width="12%">Favorites</th>
                                            <th width="12%">Purchases</th>
                                            <th width="12%">Reviews</th>
                                        </tr>
                                    </thead>`
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center user-avatar">
                                                    <img src="{{ $user->user_profile ?? asset('AdminLTE/dist/img/user2-160x160.jpg') }}" alt="{{ $user->name }}" class="user-avatar">
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </td>
                                            <td>{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height: 6px;">
                                                        @php
                                                            $maxWatchlist = $users->max('watchlist_count');
                                                            $watchlistPercentage = ($maxWatchlist > 0) ? ($user->watchlist_count / $maxWatchlist) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $watchlistPercentage }}%"></div>
                                                    </div>
                                                    <span class="badge badge-pill badge-success">{{ $user->watchlist_count }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height: 6px;">
                                                        @php
                                                            $maxFavorites = $users->max('favorite_count');
                                                            $favoritesPercentage = ($maxFavorites > 0) ? ($user->favorite_count / $maxFavorites) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $favoritesPercentage }}%"></div>
                                                    </div>
                                                    <span class="badge badge-pill badge-danger">{{ $user->favorite_count }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height: 6px;">
                                                        @php
                                                            $maxPurchases = $users->max('purchase_count');
                                                            $purchasesPercentage = ($maxPurchases > 0) ? ($user->purchase_count / $maxPurchases) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $purchasesPercentage }}%"></div>
                                                    </div>
                                                    <span class="badge badge-pill badge-warning">{{ $user->purchase_count }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height: 6px;">
                                                        @php
                                                            $maxReviews = $users->max('review_count');
                                                            $reviewsPercentage = ($maxReviews > 0) ? ($user->review_count / $maxReviews) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $reviewsPercentage }}%"></div>
                                                    </div>
                                                    <span class="badge badge-pill badge-info">{{ $user->review_count }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $users->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function() {
        // Initialize date range picker
        $('#daterange').daterangepicker({
            opens: 'left',
            locale: {
                format: 'MM/DD/YYYY'
            },
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function(start, end) {
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        });
    });
</script>
@endsection

@extends('backend.layouts.app')

@section('title', 'Content Performance Report')

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

    .movie-poster {
        width: 30px;
        height: 45px;
        object-fit: cover;
        border-radius: 3px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .rating-stars {
        color: #ffc107;
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

    .table th:nth-child(2), .table td:nth-child(2) {
        width: 5%;
    }

    .btn-sm {
        padding: 0.15rem 0.3rem;
        font-size: 0.7rem;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Content Performance Report</h1>
        <a href="{{ route('reports.print.content-performance', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}"
           class="btn btn-print" target="_blank">
            <i class="fas fa-print mr-1"></i> Print Report
        </a>
    </div>

    <!-- Date Filter -->
    <div class="row">
        <div class="col-12">
            <div class="date-filter-card">
                <form action="{{ route('reports.content-performance') }}" method="GET" class="form-inline">
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
                            <div class="stats-title text-white-50">Top Rated</div>
                            <div class="stats-number">{{ number_format($topRatedMovies->avg('avg_rating'), 1) }}</div>
                            <div class="text-white-50">Average Rating</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon text-white-50">
                                <i class="fas fa-star"></i>
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
                            <div class="stats-title text-white-50">Most Watched</div>
                            <div class="stats-number">{{ $mostWatchedMovies->sum('watchlist_count') }}</div>
                            <div class="text-white-50">Total Watchlist Adds</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon text-white-50">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats bg-gradient-info text-white h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="stats-title text-white-50">Most Favorited</div>
                            <div class="stats-number">{{ $mostFavoritedMovies->sum('favorite_count') }}</div>
                            <div class="text-white-50">Total Favorites</div>
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
                            <div class="stats-title text-white-50">Most Purchased</div>
                            <div class="stats-number">${{ number_format($mostPurchasedMovies->sum('revenue'), 0) }}</div>
                            <div class="text-white-50">Total Revenue</div>
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

    <!-- Content Tabs -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <ul class="nav nav-tabs card-header-tabs" id="contentTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-rated-tab" data-toggle="tab" href="#top-rated" role="tab">
                                <i class="fas fa-star mr-1"></i> Top Rated
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="most-watched-tab" data-toggle="tab" href="#most-watched" role="tab">
                                <i class="fas fa-eye mr-1"></i> Most Watched
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="most-favorited-tab" data-toggle="tab" href="#most-favorited" role="tab">
                                <i class="fas fa-heart mr-1"></i> Most Favorited
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="most-purchased-tab" data-toggle="tab" href="#most-purchased" role="tab">
                                <i class="fas fa-shopping-cart mr-1"></i> Most Purchased
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="contentTabsContent">
                        <!-- Top Rated Movies Tab -->
                        <div class="tab-pane fade show active" id="top-rated" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="5%">Poster</th>
                                            <th width="30%">Title</th>
                                            <th width="15%">Release Date</th>
                                            <th width="15%">Rating</th>
                                            <th width="10%">Reviews</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topRatedMovies as $movie)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($movie->poster_path)
                                                    <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="movie-poster">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center movie-poster">
                                                        <i class="fas fa-film text-secondary"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $movie->title }}</h6>
                                            </td>
                                            <td>{{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rating-stars mr-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= floor($movie->avg_rating))
                                                                <i class="fas fa-star"></i>
                                                            @elseif($i - 0.5 <= $movie->avg_rating)
                                                                <i class="fas fa-star-half-alt"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="badge badge-pill badge-primary">{{ number_format($movie->avg_rating, 1) }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-secondary">{{ $movie->review_count }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Most Watched Movies Tab -->
                        <div class="tab-pane fade" id="most-watched" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="5%">Poster</th>
                                            <th width="30%">Title</th>
                                            <th width="15%">Release Date</th>
                                            <th width="20%">Watchlist Count</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mostWatchedMovies as $movie)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($movie->poster_path)
                                                    <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="movie-poster">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center movie-poster">
                                                        <i class="fas fa-film text-secondary"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $movie->title }}</h6>
                                            </td>
                                            <td>{{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                        @php
                                                            $maxCount = $mostWatchedMovies->max('watchlist_count');
                                                            $percentage = ($maxCount > 0) ? ($movie->watchlist_count / $maxCount) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                    <span class="badge badge-pill badge-success">{{ $movie->watchlist_count }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Most Favorited Movies Tab -->
                        <div class="tab-pane fade" id="most-favorited" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="5%">Poster</th>
                                            <th width="30%">Title</th>
                                            <th width="15%">Release Date</th>
                                            <th width="20%">Favorite Count</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mostFavoritedMovies as $movie)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($movie->poster_path)
                                                    <img width="50" height="75" src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="movie-poster">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center movie-poster">
                                                        <i class="fas fa-film text-secondary"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $movie->title }}</h6>
                                            </td>
                                            <td>{{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 mr-2" style="height: 8px;">
                                                        @php
                                                            $maxCount = $mostFavoritedMovies->max('favorite_count');
                                                            $percentage = ($maxCount > 0) ? ($movie->favorite_count / $maxCount) * 100 : 0;
                                                        @endphp
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                    <span class="badge badge-pill badge-danger">{{ $movie->favorite_count }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Most Purchased Movies Tab -->
                        <div class="tab-pane fade" id="most-purchased" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="3%">#</th>
                                            <th width="5%">Poster</th>
                                            <th width="30%">Title</th>
                                            <th width="15%">Release Date</th>
                                            <th width="15%">Purchases</th>
                                            <th width="15%">Revenue</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mostPurchasedMovies as $movie)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($movie->poster_path)
                                                    <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="movie-poster">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center movie-poster">
                                                        <i class="fas fa-film text-secondary"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $movie->title }}</h6>
                                            </td>
                                            <td>{{ $movie->release_date ? $movie->release_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-warning">{{ $movie->purchase_count }}</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">${{ number_format($movie->revenue, 2) }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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

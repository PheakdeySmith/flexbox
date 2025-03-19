@extends('backend.layouts.app')

@section('title', 'Movie Revenue Report')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .movie-poster {
        width: 50px;
        height: auto;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Movie Revenue Report</h3>
                    <div class="card-tools">
                        <a href="{{ route('reports.print.movie-revenue', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" class="btn btn-sm btn-primary" target="_blank">
                            <i class="fas fa-print"></i> Print Report
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('reports.movie-revenue') }}" method="GET" class="form-inline">
                                <div class="form-group mr-2">
                                    <label for="daterange" class="mr-2">Date Range:</label>
                                    <input type="text" id="daterange" name="daterange" class="form-control" value="{{ $startDate->format('m/d/Y') }} - {{ $endDate->format('m/d/Y') }}" />
                                    <input type="hidden" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}">
                                    <input type="hidden" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Revenue</span>
                                            <span class="info-box-number">${{ number_format($totalRevenue, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Purchases</span>
                                            <span class="info-box-number">{{ $totalPurchases }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daily Revenue</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="revenueChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Movie Revenue Details</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Poster</th>
                                                <th>Title</th>
                                                <th>Release Date</th>
                                                <th>Price</th>
                                                <th>Purchases</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($movieRevenueData as $movie)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if($movie->poster_path)
                                                        <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="img-thumbnail" width="50">
                                                    @else
                                                        <span class="badge bg-secondary">No Poster</span>
                                                    @endif
                                                </td>
                                                <td>{{ $movie->title }}</td>
                                                <td>{{ $movie->release_date->format('M d, Y') }}</td>
                                                <td>${{ number_format($movie->price, 2) }}</td>
                                                <td>{{ $movie->purchase_count }}</td>
                                                <td>${{ number_format($movie->revenue, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="card-footer clearfix">
                                    <div class="d-flex justify-content-center">
                                        {{ $movieRevenueData->appends(request()->except('page'))->links() }}
                                    </div>
                                </div> --}}
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function() {
        // Date range picker
        $('#daterange').daterangepicker({
            opens: 'left',
            locale: {
                format: 'MM/DD/YYYY'
            }
        }, function(start, end) {
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        });

        // Revenue chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $chartLabels !!},
                datasets: [{
                    label: 'Daily Revenue',
                    data: {!! $chartData !!},
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor: 'rgba(60, 141, 188, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Revenue: $' + context.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">FLEX BOX Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ number_format($totalMovies) }}</h3>
                <p>Total Movies</p>
              </div>
              <div class="icon">
                <i class="fas fa-film"></i>
              </div>
              <a href="{{ route('movie.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ number_format($totalUsers) }}</h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ number_format($activeSubscriptions) }}</h3>
                <p>Active Subscriptions</p>
              </div>
              <div class="icon">
                <i class="fas fa-id-card"></i>
              </div>
              <a href="{{ route('subscription.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>${{ number_format($totalRevenue, 2) }}</h3>
                <p>Total Revenue</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="{{ route('payment.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Revenue Chart -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-line mr-1"></i>
                  Monthly Revenue & Subscribers
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="revenue-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                @if(empty($monthlyRevenue) && empty($monthlySubscribers))
                <div class="text-center mt-3">
                  <p class="text-muted">No revenue or subscriber data available for the last 6 months</p>
                </div>
                @endif
              </div>
            </div>
            <!-- /.card -->

            <!-- Popular Movies -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-trophy mr-1"></i>
                  Most Popular Movies
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Movie</th>
                      <th>Reviews</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($popularMovies as $index => $movie)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $movie->title }}</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: {{ min(100, ($movie->reviews_count ?: 1) * 5) }}%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">{{ $movie->reviews_count }}</span></td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="text-center">No movie data available</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

            <!-- Recent Reviews -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-star mr-1"></i>
                  Recent Reviews
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @forelse($recentReviews as $review)
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('backend/assets/image/user2-160x160.jpg') }}" alt="User Image">
                    <span class="username">
                      <a href="#">{{ $review->user->name }}</a>
                    </span>
                    <span class="description">Reviewed {{ $review->movie->title }} - {{ $review->created_at->diffForHumans() }}</span>
                  </div>
                  <!-- /.user-block -->
                  <p>{{ Str::limit($review->content, 150) }}</p>
                  <p>
                    <span class="float-right">
                      <i class="fas fa-star text-warning"></i> {{ $review->rating }}/5
                    </span>
                  </p>
                </div>
                <hr>
                @empty
                <div class="text-center">
                  <p class="text-muted">No recent reviews available</p>
                </div>
                @endforelse
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

          <!-- right col -->
          <section class="col-lg-5 connectedSortable">
            <!-- Recent Orders -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-shopping-cart mr-1"></i>
                  Recent Orders
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @forelse($recentOrders as $order)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ asset('backend/assets/image/user2-160x160.jpg') }}" alt="User Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">
                        {{ $order->user->name }}
                        <span class="badge badge-warning float-right">${{ number_format($order->amount ?? 0, 2) }}</span>
                      </a>
                      <span class="product-description">
                        Order #{{ $order->id }} - {{ $order->created_at->format('M d, Y') }}
                      </span>
                    </div>
                  </li>
                  @empty
                  <li class="item">
                    <div class="text-center py-3">
                      <p class="text-muted">No recent orders available</p>
                    </div>
                  </li>
                  @endforelse
                </ul>
              </div>
              <div class="card-footer text-center">
                <a href="{{ route('order.index') }}" class="uppercase">View All Orders</a>
              </div>
            </div>
            <!-- /.card -->

            <!-- Genres Distribution -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-film mr-1"></i>
                  Movie Genres Distribution
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-responsive">
                  <div class="chart" id="genre-pie-chart-container" style="height: 250px; width: 100%;">
                    <canvas id="genre-pie-chart"></canvas>
                  </div>
                </div>
                @if($genreDistribution->isEmpty())
                <div class="text-center mt-3">
                  <p class="text-muted">No genre data available</p>
                </div>
                @endif
              </div>
            </div>
            <!-- /.card -->

            <!-- Subscription Plans -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-tags mr-1"></i>
                  Subscription Plans Distribution
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-responsive">
                  <div class="chart" id="plan-pie-chart-container" style="height: 250px; width: 100%;">
                    <canvas id="plan-pie-chart"></canvas>
                  </div>
                </div>
                @if(empty($planDistribution))
                <div class="text-center mt-3">
                  <p class="text-muted">No subscription plan data available</p>
                </div>
                @endif
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('footer_scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<script>
  $(function () {
    'use strict'

    // Monthly Revenue & Subscribers Chart
    var revenueChartCanvas = document.getElementById('revenue-chart').getContext('2d');
    var months = @json(array_keys($monthlyRevenue));
    var revenue = @json(array_values($monthlyRevenue));
    var subscribers = @json(array_values($monthlySubscribers));

    // Fill empty data with zeros for better visualization
    if (months.length === 0) {
      // If no data, create dummy data for display
      months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
      revenue = [0, 0, 0, 0, 0, 0];
      subscribers = [0, 0, 0, 0, 0, 0];
    }

    var revenueChart = new Chart(revenueChartCanvas, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [
          {
            label: 'Revenue ($)',
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: revenue,
            barPercentage: 0.6,
          },
          {
            label: 'New Subscribers',
            backgroundColor: '#28a745',
            borderColor: '#28a745',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: subscribers,
            barPercentage: 0.6,
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          x: {
            display: true,
            title: {
              display: true,
              text: 'Month'
            }
          },
          y: {
            display: true,
            title: {
              display: true,
              text: 'Value'
            },
            suggestedMin: 0
          }
        }
      }
    });

    // Genre Distribution Chart
    var genreChartCanvas = document.getElementById('genre-pie-chart').getContext('2d');
    var genreLabels = @json($genreDistribution->pluck('name')->toArray() ?: ['No Data']);
    var genreData = @json($genreDistribution->pluck('movies_count')->toArray() ?: [1]);
    var backgroundColors = [
      '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#6610f2', '#fd7e14', '#20c997', '#e83e8c'
    ];

    var genreChart = new Chart(genreChartCanvas, {
      type: 'doughnut',
      data: {
        labels: genreLabels,
        datasets: [
          {
            data: genreData,
            backgroundColor: backgroundColors
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'right',
        }
      }
    });

    // Plan Distribution Chart
    var planChartCanvas = document.getElementById('plan-pie-chart').getContext('2d');
    var planLabels = @json(array_keys($planDistribution) ?: ['No Data']);
    var planData = @json(array_values($planDistribution) ?: [1]);

    var planChart = new Chart(planChartCanvas, {
      type: 'pie',
      data: {
        labels: planLabels,
        datasets: [
          {
            data: planData,
            backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545', '#007bff', '#6c757d']
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'right',
        }
      }
    });
  });
</script>
@endsection

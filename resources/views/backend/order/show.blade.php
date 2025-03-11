@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">View Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order #{{ $order->id }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('order.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary">
                                            <h5 class="card-title m-0">Order Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 30%">Order ID</th>
                                                    <td><strong>{{ $order->id }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td><span class="badge badge-info">${{ number_format($order->price, 2) }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        <span class="badge
                                                            @if($order->status == 'completed') badge-success
                                                            @elseif($order->status == 'pending') badge-warning
                                                            @else badge-danger
                                                            @endif">
                                                            {{ $order->status_label }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Created At</th>
                                                    <td>{{ $order->created_at->format('F d, Y h:i A') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Updated At</th>
                                                    <td>{{ $order->updated_at->format('F d, Y h:i A') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h5 class="card-title m-0">User Information</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($order->user)
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="mr-3">
                                                        <img src="{{ $order->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($order->user->name).'&color=7F9CF5&background=EBF4FF' }}"
                                                            alt="{{ $order->user->name }}" class="img-circle" width="80" height="80">
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-1">{{ $order->user->name }}</h5>
                                                        <p class="mb-0 text-muted">{{ $order->user->email }}</p>
                                                    </div>
                                                </div>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 30%">User ID</th>
                                                        <td>{{ $order->user->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Joined</th>
                                                        <td>{{ $order->user->created_at->format('F d, Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Orders</th>
                                                        <td>{{ App\Models\OrderItem::where('user_id', $order->user->id)->count() }}</td>
                                                    </tr>
                                                </table>
                                                <div class="mt-3">
                                                    <a href="{{ route('user.profile') }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-user"></i> View User Profile
                                                    </a>
                                                </div>
                                            @else
                                                <div class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> User information not available
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            <h5 class="card-title m-0">Movie Information</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($order->movie)
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative">
                                                            @if($order->movie->poster)
                                                                <img src="{{ Str::startsWith($order->movie->poster, 'http') ? $order->movie->poster : asset('storage/' . $order->movie->poster) }}"
                                                                    class="img-fluid rounded" alt="{{ $order->movie->title }}">
                                                            @elseif($order->movie->poster_url)
                                                                <img src="{{ $order->movie->poster_url }}"
                                                                    class="img-fluid rounded" alt="{{ $order->movie->title }}">
                                                            @else
                                                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 300px;">
                                                                    <i class="fas fa-film fa-4x text-white"></i>
                                                                </div>
                                                            @endif
                                                            <span class="badge badge-pill badge-danger position-absolute" style="top: 10px; right: 10px;">
                                                                {{ $order->movie->imdb_rating ?? 'N/A' }} <i class="fas fa-star"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h3>{{ $order->movie->title }}</h3>
                                                        <div class="mb-3">
                                                            @if($order->movie->release_date)
                                                                <span class="badge badge-secondary mr-2">
                                                                    <i class="far fa-calendar-alt mr-1"></i> {{ $order->movie->release_date->format('Y') }}
                                                                </span>
                                                            @endif
                                                            @if($order->movie->runtime)
                                                                <span class="badge badge-secondary mr-2">
                                                                    <i class="far fa-clock mr-1"></i> {{ $order->movie->runtime }} min
                                                                </span>
                                                            @endif
                                                            @if($order->movie->price)
                                                                <span class="badge badge-success">
                                                                    <i class="fas fa-tag mr-1"></i> ${{ number_format($order->movie->price, 2) }}
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            @if($order->movie->genres)
                                                                @foreach($order->movie->genres as $genre)
                                                                    <span class="badge badge-info mr-1">{{ $genre->name }}</span>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <h5>Overview</h5>
                                                        <p>{{ $order->movie->overview ?? 'No overview available.' }}</p>

                                                        <div class="mt-4">
                                                            <a href="{{ route('movie.show', $order->movie->id) }}" class="btn btn-primary">
                                                                <i class="fas fa-info-circle"></i> View Movie Details
                                                            </a>
                                                            <a href="{{ route('movie.edit', $order->movie->id) }}" class="btn btn-secondary">
                                                                <i class="fas fa-edit"></i> Edit Movie
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i> Movie information not available
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('order.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left mr-1"></i> Back to Orders
                                        </a>
                                        <div>
                                            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary mr-2">
                                                <i class="fas fa-edit mr-1"></i> Edit Order
                                            </a>
                                            <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">
                                                    <i class="fas fa-trash mr-1"></i> Delete Order
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        color: white;
    }
    .badge {
        font-size: 90%;
    }
</style>
@endsection

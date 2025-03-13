@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div style="margin-top: 500px;">
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <h2 class="title">Watch Movie</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a></li>
                            <li class="breadcrumb-item active">Watch</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="video-container">
                        @if($movie->video_url)
                            <video id="movie-player" class="w-100" controls>
                                <source src="{{ $movie->video_url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <div class="alert alert-warning">
                                Video content is not available at the moment.
                            </div>
                        @endif
                    </div>

                    <div class="movie-info mt-4">
                        <h3>{{ $movie->title }}</h3>
                        <div class="movie-meta">
                            <span class="duration">{{ $movie->duration }}</span>
                            <span class="rating">{{ $movie->rating }}</span>
                            <span class="release-year">{{ $movie->release_year }}</span>
                        </div>
                        <p class="mt-3">{{ $movie->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        background: #000;
    }

    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .movie-info {
        background: rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
    }

    .movie-meta {
        color: #666;
        font-size: 0.9rem;
    }

    .movie-meta span:not(:last-child):after {
        content: "•";
        margin: 0 10px;
    }
</style>
@endpush

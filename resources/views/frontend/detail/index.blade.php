@extends('frontend.layouts.app')

@section('styles')
  <style class="vjs-styles-defaults">

    .video-js {
      width: 300px;
      height: 150px;
    }

    .vjs-fluid {
      padding-top: 56.25%
    }
  </style>
  <style class="vjs-styles-dimensions">
    .my-video-dimensions {
      width: 1920px;
      height: 1080px;
    }

    .my-video-dimensions.vjs-fluid {
      padding-top: 56.25%;
    }
  </style>

  <style type="text/css">
    .vjs-youtube .vjs-iframe-blocker {
      display: none;
    }

    .vjs-youtube.vjs-user-inactive .vjs-iframe-blocker {
      display: block;
    }

    .vjs-youtube .vjs-poster {
      background-size: cover;
    }

    .vjs-youtube-mobile .vjs-big-play-button {
      display: none;
    }

  </style>

@endsection

@section('content')


        <!-- Site Video -->
        @include('frontend.partials.site-video')
        <!-- Site Video -->

    @include('frontend.partials.details-part')


    @include('frontend.partials.cast-tabs')

    @include('frontend.partials.recommended-block')

    @include('frontend.partials.related-movie-block')

    @include('frontend.partials.video-block')

    @include('frontend.partials.popular-movies-block')

    {{-- @include('frontend.partials.upcomimg-block') --}}

@endsection

@push('styles')
<style>
    .custom-style {
        margin-top: 20px;
    }
</style>
@endpush

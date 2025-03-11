@extends('frontend.layouts.app')

@section('content')

    @include('frontend.partials.slider')

    {{-- @include('frontend.partials.continue-watching') --}}

    @include('frontend.partials.top-ten-block')

    @include('frontend.partials.verticle-slider')

    @include('frontend.partials.popular-movies-block')

    @include('frontend.partials.favourite-person-block')

    @include('frontend.partials.movie-geners-block')

    @include('frontend.partials.recommended-block')

    {{-- @include('frontend.partials.streamit-card') --}}

    {{-- @include('frontend.partials.streamit-block') --}}

    {{-- @include('frontend.partials.tab-slider') --}}

    {{-- @include('frontend.partials.top-pics-block') --}}

@endsection

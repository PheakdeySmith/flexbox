<div class="details-part">
    <div class="container-fluid">
        <div class="row">
            @if ($movie)
                <div class="col-lg-12">
                    <!-- Movie Description Start-->
                    <div class="trending-info mt-4 pt-0 pb-4">
                        <div class="row">
                            <div class="col-md-9 col-12 mb-auto">
                                <div class="d-block d-lg-flex align-items-center">
                                    <h2 class="trending-text fw-bold texture-text text-uppercase my-0 fadeInLeft animated d-inline-block"
                                        data-animation-in="fadeInLeft" data-delay-in="0.6"
                                        style="opacity: 1; animation-delay: 0.6s">
                                        {{ $movie->title }}
                                    </h2>
                                    <div class="slider-ratting d-flex align-items-center ms-lg-3 ms-0">
                                        <ul
                                            class="ratting-start p-0 m-0 list-inline text-warning d-flex align-items-center justify-content-left">
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star-half" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="text-white ms-2">{{ $movie->imdb_rating }} (imdb)</span>
                                    </div>
                                </div>
                                <ul class="p-0 mt-2 list-inline d-flex flex-wrap movie-tag">
                                    @foreach ($movie->genres as $genre)
                                    <li class="trending-list"><a class="text-primary"
                                            href="">{{ $genre->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="d-flex flex-wrap align-items-center text-white text-detail flex-wrap mb-4">
                                    {{-- <span class="badge bg-secondary">{{ $movie->genres->first()->name }}</span> --}}
                                    <span class="ms-3 font-Weight-500 genres-info me-1">{{ $movie->duration }}
                                        mins</span>
                                    <span class="trending-year trending-year-list font-Weight-500 genres-info">
                                        {{ $movie->release_date }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-4 flex-wrap mb-4">
                                    <ul class="list-inline p-0 share-icons music-play-lists mb-n2 mx-n2">
                                        <li><span><i class="fa-solid fa-plus"></i></span></li>

                                    </ul>

                                    @if(auth()->check())
                                        @php
                                            $user = auth()->user();
                                            $hasBoughtMovie = false;

                                            // Check if user has bought this movie
                                            if (isset($movie) && $movie) {
                                                $hasBoughtMovie = $user->orders()
                                                    ->whereHas('items', function($query) use ($movie) {
                                                        $query->where('movie_id', $movie->id);
                                                    })
                                                    ->where('status', 'completed')
                                                    ->exists();
                                            }
                                        @endphp

                                        @if(!$hasBoughtMovie)
                                            <div class="iq-button">
                                                <a href="{{ route('frontend.addToCart', $movie->id) }}" class="btn btn-sm" id="button-addon2">Add to Cart</a>
                                            </div>
                                        @else
                                            <div class="iq-button">
                                                <span class="btn btn-sm btn-success disabled">
                                                    <i class="fa-solid fa-check me-1"></i> Purchased
                                                </span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="iq-button">
                                            <a href="{{ route('frontend.addToCart', $movie->id) }}" class="btn btn-sm" id="button-addon2">Add to Cart</a>
                                        </div>
                                    @endif

                                    {{-- <div class="movie-detail-select">
                                        <select name="movieselect"
                                        class="form-control movie-select select2-basic-single js-states select2-hidden-accessible"
                                        data-select2-id="select2-data-1-p70u" tabindex="-1" aria-hidden="true" data-sharkid="__0">
                                        <option value="1" data-select2-id="select2-data-3-rrt2">Playlist</option>
                                        <option value="2">Zombie Island</option>
                                        <option value="3">Sand Dust</option>
                                        <option value="4">Jumbo Queen</option>
                                        </select>
                                    </div> --}}

                                </div>
                                <ul class="iq-blogtag list-unstyled d-flex flex-wrap align-items-center gap-3 p-0">
                                    <li class="iq-tag-title text-primary mb-0">
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        Tags:
                                    </li>
                                    <li><a class="title"
                                            href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Action</a><span
                                            class="text-secondary">,</span></li>
                                    <li><a class="title"
                                            href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Adventure</a><span
                                            class="text-secondary">,</span></li>
                                    <li><a class="title"
                                            href="https://templates.iqonic.design/streamit-dist/frontend/html/view-all-movie.html">Drama</a><span
                                            class="text-secondary">,</span></li>
                                </ul>
                            </div>
                            <div class="trailor-video col-md-3 col-12 mt-lg-0 mt-4 mb-md-0 mb-1 text-lg-right">
                                <a data-fslightbox="html5-video" href="{{ $movie->trailer_url }}"
                                    class="video-open playbtn block-images position-relative playbtn_thumbnail">
                                    <img src="{{ $movie->backdrop_url }}"
                                        class="attachment-medium-large size-medium-large wp-post-image" alt=""
                                        loading="lazy">
                                    <span class="content btn btn-transparant iq-button">
                                        <i class="fa fa-play me-2 text-white"></i>
                                        <span>Trailer Link</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Movie Description End --> <!-- Movie Source Start -->
                    <div class="content-details trending-info">
                        <ul class="iq-custom-tab tab-bg-gredient-center d-flex nav nav-pills align-items-center text-center mb-5 justify-content-center list-inline"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link show active" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html#description-01"
                                    role="tab" aria-selected="true">
                                    Description
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="pill"
                                    href="https://templates.iqonic.design/streamit-dist/frontend/html/movie-detail.html#review-01"
                                    role="tab" aria-selected="false" tabindex="-1">
                                    Rate &amp; Review
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="description-01" class="tab-pane animated fadeInUp active show" role="tabpanel">
                                <div class="description-content">
                                    <p>
                                        {{ $movie->description }}
                                    </p>
                                </div>
                            </div>
                            <div id="review-01" class="tab-pane animated fadeInUp" role="tabpanel">
                                <div class="streamit-reviews">
                                    <div id="comments" class="comments-area validate-form">
                                        <p class="masvideos-noreviews mt-3">
                                            There are no reviews yet.
                                        </p>
                                    </div>
                                    <div class="review_form">
                                        <div class="comment-respond">
                                            <h3 class="fw-500 my-2">
                                                Be the first to review "{{ $movie->title }}"
                                            </h3>
                                            <p class="comment-notes"><span>Your email address will not be
                                                    published.</span><span> Required fields are marked<span
                                                        class="required"> * </span></span>
                                            </p>
                                            <div class="d-flex align-items-center mb-4"><label>Your
                                                    rating</label>
                                                <div class="star ms-4 text-primary"><span><i
                                                            class="fa-regular fa-star"></i></span> <span><i
                                                            class="fa-regular fa-star"></i></span> <span><i
                                                            class="fa-regular fa-star"></i></span>
                                                    <span><i class="fa-regular fa-star"></i></span> <span><i
                                                            class="fa-regular fa-star"></i></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">
                                                            Your review
                                                            <span class="required">
                                                                *
                                                            </span>
                                                        </label>
                                                        <textarea class="form-control" name="comment" cols="5" rows="8" required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="mb-2">
                                                            Name
                                                            <span class="required">
                                                                *
                                                            </span>
                                                        </label>
                                                        <input class="form-control" name="author" type="text"
                                                            value="" size="30" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="mb-2">
                                                            Email&nbsp;
                                                            <span class="required">
                                                                *
                                                            </span>
                                                        </label>
                                                        <input class="form-control" name="email" type="email"
                                                            value="" size="30" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mt-3 mt-3 d-flex gap-2 align-items-center">
                                                        <input class="form-check-input mt-0" type="checkbox"
                                                            value="" id="check1" checked="">
                                                        <label class="form-check-label" for="check1">
                                                            Save my name, email, and website in this browser for the
                                                            next time I comment.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-submit mt-4">
                                                        <div class="iq-button">
                                                            <button name="submit" type="submit" id="submit"
                                                                class="btn text-uppercase position-relative"
                                                                value="Submit">
                                                                <span class="button-text">Submit</span>
                                                                <i class="fa-solid fa-play"></i>
                                                            </button>
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
                    <!-- Movie Source End -->
                </div>
            @else
                <p>Movie not found.</p>
            @endif
        </div>
    </div>
</div>

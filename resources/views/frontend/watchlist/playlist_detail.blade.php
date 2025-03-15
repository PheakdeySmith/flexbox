@extends('frontend.layouts.app')

@section('content')
    <section class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="playlist-main-banner position-relative">
                        <a href="https://templates.iqonic.design/streamit-dist/frontend/html/video-detail.html"
                            class="position-absolute top-0 bottom-0 start-0 end-0 z-1"></a>
                        <div class="img-box d-flex justify-content-between align-items-start" style="margin-left: 200px;">
                            <div>
                                <h4 class="fw-500">{{ $playlist->name }}</h4>
                                <div class="d-flex align-items-center gap-3">
                                    {{-- <div class="d-flex align-items-center gap-1 font-size-12">
                                        <i class="fa-solid fa-star text-primary"></i>
                                        <span
                                            class="text-body fw-semibold text-capitalize">{{ $playlist->movies->first()->created_at }}</span>
                                    </div> --}}

                                    <div class="d-flex align-items-center gap-1 font-size-12">
                                        <i class="fa-regular fa-clock text-primary"></i>
                                        <span class="text-body fw-semibold text-capitalize">{{ $playlist->movies->count() }}
                                            videos</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="playlist-listing mt-4 mt-md-0">

                        <ul class="list-inline mt-3 mt-md-5 p-0">
                            <li>
                                <div class="watchlist-warpper card-style-two" style="margin-top: -20px;">
                                    @foreach ($playlist->movies as $movie)
                                        <div
                                            class="block-images d-flex align-items-center justify-content-between flex-wrap gap-2 gap-md-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="img-box">
                                                    <a href="{{ route('frontend.detail', $movie->id) }}"
                                                        class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                                    <img src="{{ $movie->backdrop_url }}" alt="movie-card"
                                                        class="img-fluid object-cover d-block border-0">
                                                </div>
                                                <div class="card-description">
                                                    <h5 class="text-capitalize fw-500 mb-0">
                                                        <a
                                                            href="{{ route('frontend.detail', $movie->id) }}">{{ $movie->title }}</a>
                                                    </h5>
                                                    <div class="seperator d-flex align-items-center">
                                                        <span
                                                            class="text-body fw-semibold font-size-12 text-capitalize">{{ $movie->duration }}</span>
                                                        <span class="circle circle-small"></span>
                                                        <span
                                                            class="text-body fw-semibold font-size-12 text-capitalize">{{ $movie->created_at }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button href="#" class="btn-remove"
                                            data-id="{{ $movie->id }}"
                                            data-url="{{ route('playlist.removeMovie', ['playlist' => $playlist->id, 'movie' => $movie->id]) }}"
                                            data-source="frontend">
                                            <i class="fa-regular fa-trash-can"></i>
                                            </button>

                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    .btn-remove {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        padding: 0;
        flex-shrink: 0;
        transform: translateY(-5px);
        align-self: flex-start;
    }

    .btn-remove i {
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        border-color: rgba(255, 77, 77, 0.5);
        background: rgba(255, 77, 77, 0.1);
    }

    .btn-remove:hover i {
        color: #ff4d4d;
        transform: scale(1.1);
    }
</style>


    <script>
        // document.querySelectorAll('.btn-remove').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const movieId = this.dataset.movieId;
        //         const playlistId = this.dataset.playlistId;
        //         const item = this.closest('.block-images');

        //         item.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        //         item.style.opacity = '0';
        //         item.style.transform = 'scale(0.95)';


        //     });
        // });
        document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const movieId = this.getAttribute('data-movie-id');
            const playlistId = this.getAttribute('data-playlist-id');
            const deleteUrl = this.getAttribute('data-url');
            const source = this.getAttribute('data-source'); // Get source value
            const item = this.closest('.block-images');

            Swal.fire({
                title: 'Remove Movie?',
                text: 'Are you sure you want to remove this movie from the playlist?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then(result => {
                if (result.isConfirmed) {
                    // Create a form dynamically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
                    form.style.display = 'none';

                    // CSRF Token and DELETE Method
                    form.appendChild(createInput('_token', '{{ csrf_token() }}'));
                    form.appendChild(createInput('_method', 'DELETE'));
                    form.appendChild(createInput('source', source)); // Send source

                    document.body.appendChild(form);
                    form.submit();

                    // Remove item visually
                    item.style.transition = 'all 0.4s ease';
                    item.style.opacity = '0';
                    setTimeout(() => item.remove(), 400);
                }
            });
        });
    });
});

// Function to create hidden input elements
function createInput(name, value) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    return input;
}

    </script>


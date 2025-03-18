@extends('frontend.layouts.app')

@section('content')
    <!--bread-crumb-->
    <div class="iq-breadcrumb" style="background-image: url({{ asset('frontend/assets') }}/images/background.webp);">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb" class="text-center">
              <h2 class="title">{{ isset($directors) ? 'Directors' : 'Cast' }}</h2>
              <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ isset($directors) ? 'Directors' : 'Cast' }}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div> <!--bread-crumb-->

    <section class="section-padding">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6" id="items-container">
          @if(isset($directors) && count($directors) > 0)
            @foreach($directors as $director)
              <div class="col item">
                <div class="iq-cast">
                  <img src="{{ $director->profile_photo ? $director->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="img-fluid" alt="{{ $director->name }}">
                  <div class="card-img-overlay iq-cast-body">
                    <h6 class="cast-title fw-500">
                      <a href="{{ route('frontend.directorDetail', ['id' => $director->id]) }}">
                        {{ $director->name }}
                      </a>
                    </h6>
                    <span class="cast-subtitle">
                      Director
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
          @elseif(isset($actors) && count($actors) > 0)
            @foreach($actors as $actor)
              <div class="col item">
                <div class="iq-cast">
                  <img src="{{ $actor->profile_photo ? $actor->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="img-fluid" alt="{{ $actor->name }}">
                  <div class="card-img-overlay iq-cast-body">
                    <h6 class="cast-title fw-500">
                      <a href="{{ route('frontend.actorDetail', ['id' => $actor->id]) }}">
                        {{ $actor->name }}
                      </a>
                    </h6>
                    <span class="cast-subtitle">
                      Actor
                    </span>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="col-12">
              <div class="alert alert-info">
                No {{ isset($directors) ? 'directors' : 'actors' }} found.
              </div>
            </div>
          @endif
        </div>

        <!-- Loading indicator -->
        <div class="text-center mt-4 mb-5 d-none" id="loading-indicator">
          <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <p class="mt-2 text-light">Loading more...</p>
        </div>

        <!-- No more content message -->
        <div class="text-center mt-4 mb-5 d-none" id="no-more-content">
          <p class="text-light">No more content to load</p>
        </div>
      </div>
    </section>


    <!-- Test content container -->
    <div id="test-content-container" class="container-fluid mb-5 d-none">
      <h4 class="text-light mb-3">Test Content from Page 2:</h4>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-6" id="test-items-container">
        <!-- Test items will be inserted here -->
      </div>
    </div>

@endsection

@push('styles')
<style>
  #loading-indicator {
    padding: 20px 0;
  }
  #loading-indicator .spinner-border {
    width: 3rem;
    height: 3rem;
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables based on the current page data
    const totalPages = {{ isset($directors) ? $directors->lastPage() : $actors->lastPage() }};
    const currentPage = {{ isset($directors) ? $directors->currentPage() : $actors->currentPage() }};
    let nextPage = currentPage + 1;
    let loading = false;
    let hasMorePages = nextPage <= totalPages;


    // Elements
    const container = document.getElementById('items-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const noMoreContent = document.getElementById('no-more-content');

    // Test AJAX button (for debug only)
    const testAjaxBtn = document.getElementById('test-ajax-btn');
    const testAjaxResult = document.getElementById('test-ajax-result');
    const testContentContainer = document.getElementById('test-content-container');
    const testItemsContainer = document.getElementById('test-items-container');

    if (testAjaxBtn) {
      testAjaxBtn.addEventListener('click', function() {
        testAjaxResult.textContent = 'Loading...';

        // Clear previous test content
        testItemsContainer.innerHTML = '';
        testContentContainer.classList.add('d-none');

        // Create a test URL for page 2
        const testUrl = `${window.location.pathname}?page=2&ajax=1&test=1`;

        fetch(testUrl, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => {
          testAjaxResult.textContent = `Response status: ${response.status}`;
          const contentType = response.headers.get('content-type');

          if (contentType && contentType.includes('application/json')) {
            return response.json().then(data => {
              return { type: 'json', data: data };
            });
          } else {
            return response.text().then(text => {
              return { type: 'html', data: text };
            });
          }
        })
        .then(result => {
          if (result.type === 'json') {
            testAjaxResult.textContent += `, JSON response: ${JSON.stringify(result.data)}`;
          } else {
            testAjaxResult.textContent += `, Content length: ${result.data.length} chars`;

            // Display the fetched content if it's not empty
            if (result.data.trim() !== '' && !result.data.includes('no-more-items')) {
              testItemsContainer.innerHTML = result.data;
              testContentContainer.classList.remove('d-none');
            } else {
              testAjaxResult.textContent += ' (No content or end of list)';
            }
          }
        })
        .catch(error => {
          testAjaxResult.textContent = `Error: ${error.message}`;
          console.error('Test error:', error);
        });
      });
    }

    // Only set up scroll handling if there are more pages
    if (!hasMorePages) {
      noMoreContent.classList.remove('d-none');
    }

    // Show loading indicator during fetch
    function showLoading() {
      loading = true;
      loadingIndicator.classList.remove('d-none');
    }

    // Hide loading indicator after fetch
    function hideLoading() {
      loading = false;
      loadingIndicator.classList.add('d-none');
    }

    // Load more content function
    async function loadMoreContent() {
      if (loading || !hasMorePages) return;

      showLoading();

      try {
        // Create URL with page parameter
        const url = `${window.location.pathname}?page=${nextPage}&ajax=1`;

        // Fetch next page
        const response = await fetch(url, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const contentType = response.headers.get('content-type');

        // Handle different response types
        if (contentType && contentType.includes('application/json')) {
          // JSON response (likely an empty indicator)
          const data = await response.json();

          if (data.status === 'empty') {
            hasMorePages = false;
            noMoreContent.classList.remove('d-none');
          }
        } else {
          // HTML response
          const html = await response.text();

          // Check if we have content
          if (html.trim() === '' || html.includes('no-more-items')) {
            hasMorePages = false;
            noMoreContent.classList.remove('d-none');
          } else {
            // Append content
            container.insertAdjacentHTML('beforeend', html);

            // Increment page counter
            nextPage++;

            // Check if we've reached the last page
            if (nextPage > totalPages) {
              hasMorePages = false;
              setTimeout(() => {
                noMoreContent.classList.remove('d-none');
              }, 1000);
            }
          }
        }
      } catch (error) {
        console.error('Error loading more content:', error);
      } finally {
        hideLoading();
      }
    }

    // Scroll handler
    function handleScroll() {
      // Calculate position
      const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

      // If we're close to the bottom and not currently loading
      if (scrollTop + clientHeight >= scrollHeight - 300 && !loading && hasMorePages) {
        loadMoreContent();
      }
    }

    // Add scroll event listener
    window.addEventListener('scroll', handleScroll);

    // Initial check if page is too short
    setTimeout(() => {
      const { scrollHeight, clientHeight } = document.documentElement;

      if (scrollHeight <= clientHeight + 100 && hasMorePages) {
        loadMoreContent();
      } else if (hasMorePages && currentPage === 1) {
        // Force load page 2 to demonstrate the functionality
        loadMoreContent();
      }
    }, 1000);
  });
</script>
@endpush

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
  <div class="col-12 no-more-items">
    <div class="alert alert-info">
      No more {{ isset($directors) ? 'directors' : 'actors' }} to load.
    </div>
  </div>
@endif

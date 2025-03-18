@if(isset($directors) && count($directors) > 0)
    @foreach($directors as $director)
    <div class="col item">
        <div class="card mb-3">
            <img src="{{ $director->profile_photo ? $director->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="card-img-top" alt="{{ $director->name }}">
            <div class="card-body">
                <h6 class="card-title">{{ $director->name }}</h6>
                <p class="card-text"><small class="text-muted">Director</small></p>
            </div>
        </div>
    </div>
    @endforeach
@elseif(isset($actors) && count($actors) > 0)
    @foreach($actors as $actor)
    <div class="col item">
        <div class="card mb-3">
            <img src="{{ $actor->profile_photo ? $actor->profile_photo : asset('frontend/assets/images/default-profile.png') }}" class="card-img-top" alt="{{ $actor->name }}">
            <div class="card-body">
                <h6 class="card-title">{{ $actor->name }}</h6>
                <p class="card-text"><small class="text-muted">Actor</small></p>
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

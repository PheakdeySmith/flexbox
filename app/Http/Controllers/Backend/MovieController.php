<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Exception;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('backend.movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.movie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tmdb_id' => 'nullable|integer|unique:movies',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster_url' => 'nullable|string|max:255',
            'backdrop_url' => 'nullable|string|max:255',
            'duration' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
            'trailer_url' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:255',
            'imdb_rating' => 'nullable|numeric|min:0|max:10',
            'country' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'type' => 'required|in:movie,tv_series',
            'maturity_rating' => 'nullable|in:G,PG,PG-13,R,NC-17',
            'is_free' => 'boolean',
            'status' => 'required|in:active,inactive',
            'actors' => 'nullable|array',
            'actors.*.id' => 'nullable|integer',
            'actors.*.name' => 'required|string|max:255',
            'actors.*.profile_photo' => 'nullable|string',
            'actors.*.character' => 'nullable|string',
            'actors.*.birth_date' => 'nullable|date',
            'actors.*.biography' => 'nullable|string',
            'genres' => 'nullable|array',
            'genres.*.id' => 'nullable|integer',
            'genres.*.name' => 'required|string|max:255',
            'directors' => 'nullable|array',
            'directors.*.id' => 'nullable|integer',
            'directors.*.name' => 'required|string|max:255',
            'directors.*.profile_photo' => 'nullable|string',
            'directors.*.biography' => 'nullable|string',
            'directors.*.job' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('movie.create')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Create the movie
        $movie = Movie::create($request->except(['actors', 'genres', 'directors']));

        // Handle actors if provided
        if ($request->has('actors') && is_array($request->actors)) {
            $actorCount = 0;
            $newActorCount = 0;
            $actorsToSync = [];

            foreach ($request->actors as $actorData) {
                $actorCount++;

                // Check if actor already exists by TMDB ID
                $actor = null;
                if (!empty($actorData['id'])) {
                    $actor = Actor::where('tmdb_id', $actorData['id'])->first();
                }

                if (!$actor) {
                    // Try to find by name as fallback
                    $actor = Actor::where('name', $actorData['name'])->first();
                }

                // Create new actor if not found
                if (!$actor) {
                    $actor = Actor::create([
                        'tmdb_id' => $actorData['id'] ?? null,
                        'name' => $actorData['name'],
                        'profile_photo' => $actorData['profile_photo'] ?? null,
                        'birth_date' => $actorData['birth_date'] ?? null,
                        'biography' => $actorData['biography'] ?? null,
                    ]);
                    $newActorCount++;
                } else {
                    // Update existing actor with any new information
                    $updateData = [];

                    // Only update if the field is provided and not empty
                    if (isset($actorData['profile_photo']) && !empty($actorData['profile_photo']) && $actor->profile_photo != $actorData['profile_photo']) {
                        $updateData['profile_photo'] = $actorData['profile_photo'];
                    }

                    if (isset($actorData['birth_date']) && !empty($actorData['birth_date']) && $actor->birth_date != $actorData['birth_date']) {
                        $updateData['birth_date'] = $actorData['birth_date'];
                    }

                    if (isset($actorData['biography']) && !empty($actorData['biography']) && $actor->biography != $actorData['biography']) {
                        $updateData['biography'] = $actorData['biography'];
                    }

                    // Update the actor if there are changes
                    if (!empty($updateData)) {
                        $actor->update($updateData);
                    }
                }

                // Create relationship with character name if provided
                $pivotData = [];
                if (isset($actorData['character']) && !empty($actorData['character'])) {
                    $pivotData['character'] = $actorData['character'];
                }

                // Add to the array of actors to sync
                $actorsToSync[$actor->id] = $pivotData;
            }

            // Sync all actors at once
            $movie->actors()->sync($actorsToSync);

            $message = "Movie created successfully with {$actorCount} actors";
            if ($newActorCount > 0) {
                $message .= " ({$newActorCount} new actors created)";
            }
        }

        // Handle genres if provided
        if ($request->has('genres') && is_array($request->genres)) {
            $genreCount = 0;
            $newGenreCount = 0;
            $genresToSync = [];

            foreach ($request->genres as $genreData) {
                $genreCount++;

                // Check if genre already exists by TMDB ID
                $genre = null;
                if (!empty($genreData['id'])) {
                    $genre = Genre::where('tmdb_id', $genreData['id'])->first();
                }

                if (!$genre) {
                    // Try to find by name as fallback
                    $genre = Genre::where('name', $genreData['name'])->first();
                }

                // Create new genre if not found
                if (!$genre) {
                    $genre = Genre::create([
                        'tmdb_id' => $genreData['id'] ?? null,
                        'name' => $genreData['name'],
                        'slug' => \Illuminate\Support\Str::slug($genreData['name']),
                    ]);
                    $newGenreCount++;
                }

                // Add to the array of genres to sync
                $genresToSync[] = $genre->id;
            }

            // Sync all genres at once
            $movie->genres()->sync($genresToSync);

            $message = "Movie created successfully with {$genreCount} genres";
            if ($newGenreCount > 0) {
                $message .= " ({$newGenreCount} new genres created)";
            }
        }

        // Handle directors if provided
        if ($request->has('directors') && is_array($request->directors)) {
            $directorCount = 0;
            $newDirectorCount = 0;
            $directorsToSync = [];

            foreach ($request->directors as $directorData) {
                $directorCount++;

                // Check if director already exists by TMDB ID
                $director = null;
                if (!empty($directorData['id'])) {
                    $director = Director::where('tmdb_id', $directorData['id'])->first();
                }

                if (!$director) {
                    // Try to find by name as fallback
                    $director = Director::where('name', $directorData['name'])->first();
                }

                // Create new director if not found
                if (!$director) {
                    $director = Director::create([
                        'tmdb_id' => $directorData['id'] ?? null,
                        'name' => $directorData['name'],
                        'profile_photo' => $directorData['profile_photo'] ?? null,
                        'biography' => $directorData['biography'] ?? null,
                    ]);
                    $newDirectorCount++;
                } else {
                    // Update existing director with any new information
                    $updateData = [];

                    // Only update if the field is provided and not empty
                    if (isset($directorData['profile_photo']) && !empty($directorData['profile_photo']) && $director->profile_photo != $directorData['profile_photo']) {
                        $updateData['profile_photo'] = $directorData['profile_photo'];
                    }

                    if (isset($directorData['biography']) && !empty($directorData['biography']) && $director->biography != $directorData['biography']) {
                        $updateData['biography'] = $directorData['biography'];
                    }

                    // Update the director if there are changes
                    if (!empty($updateData)) {
                        $director->update($updateData);
                    }
                }

                // Create relationship with job if provided
                $pivotData = [];
                if (isset($directorData['job']) && !empty($directorData['job'])) {
                    $pivotData['job'] = $directorData['job'];
                }

                // Add to the array of directors to sync
                $directorsToSync[$director->id] = $pivotData;
            }

            // Sync all directors at once
            $movie->directors()->sync($directorsToSync);

            $message = "Movie created successfully with {$directorCount} directors";
            if ($newDirectorCount > 0) {
                $message .= " ({$newDirectorCount} new directors created)";
            }
        }

        return redirect()->route('movie.index')
            ->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::with(['actors', 'directors', 'genres'])->findOrFail($id);
        return view('backend.movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::with(['actors', 'directors', 'genres'])->findOrFail($id);

        // Get counts for featured movies
        $featuredCount = Movie::where('is_featured', 1)->count();
        $featuredVerticalCount = Movie::where('is_featured_vertical', 1)->count();

        return view('backend.movie.edit', compact('movie', 'featuredCount', 'featuredVerticalCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        // Check featured limits only if the movie isn't already featured
        if ($request->has('is_featured') && $request->is_featured && !$movie->is_featured) {
            $featuredCount = Movie::where('is_featured', 1)->count();
            if ($featuredCount >= 5) {
                return redirect()->back()->with('error', 'Maximum limit of 5 featured movies has been reached.');
            }
        }

        if ($request->has('is_featured_vertical') && $request->is_featured_vertical && !$movie->is_featured_vertical) {
            $featuredVerticalCount = Movie::where('is_featured_vertical', 1)->count();
            if ($featuredVerticalCount >= 5) {
                return redirect()->back()->with('error', 'Maximum limit of 5 featured vertical movies has been reached.');
            }
        }

        $validator = Validator::make($request->all(), [
            'tmdb_id' => ['nullable', 'integer', Rule::unique('movies')->ignore($id)],
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster_url' => 'nullable|string|max:255',
            'backdrop_url' => 'nullable|string|max:255',
            'duration' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
            'trailer_url' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:255',
            'imdb_rating' => 'nullable|numeric|min:0|max:10',
            'country' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'type' => 'required|in:movie,tv_series',
            'maturity_rating' => 'nullable|in:G,PG,PG-13,R,NC-17',
            'is_free' => 'boolean',
            'is_featured' => 'boolean',
            'is_featured_vertical' => 'boolean',
            'status' => 'required|in:active,inactive',
            'actors' => 'nullable|array',
            'actors.*.id' => 'nullable|integer',
            'actors.*.name' => 'required|string|max:255',
            'actors.*.profile_photo' => 'nullable|string',
            'actors.*.character' => 'nullable|string',
            'actors.*.birth_date' => 'nullable|date',
            'actors.*.biography' => 'nullable|string',
            'genres' => 'nullable|array',
            'genres.*.id' => 'nullable|integer',
            'genres.*.name' => 'required|string|max:255',
            'directors' => 'nullable|array',
            'directors.*.id' => 'nullable|integer',
            'directors.*.name' => 'required|string|max:255',
            'directors.*.profile_photo' => 'nullable|string',
            'directors.*.biography' => 'nullable|string',
            'directors.*.job' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('movie.edit', $id)
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Update the movie
        $movie->update($request->except(['actors', 'genres', 'directors']));

        // Handle actors if provided
        if ($request->has('actors') && is_array($request->actors)) {
            $actorCount = 0;
            $newActorCount = 0;
            $actorsToSync = [];

            foreach ($request->actors as $actorData) {
                $actorCount++;

                // Check if actor already exists by TMDB ID
                $actor = null;
                if (!empty($actorData['id'])) {
                    $actor = Actor::where('tmdb_id', $actorData['id'])->first();
                }

                if (!$actor) {
                    // Try to find by name as fallback
                    $actor = Actor::where('name', $actorData['name'])->first();
                }

                // Create new actor if not found
                if (!$actor) {
                    $actor = Actor::create([
                        'tmdb_id' => $actorData['id'] ?? null,
                        'name' => $actorData['name'],
                        'profile_photo' => $actorData['profile_photo'] ?? null,
                        'birth_date' => $actorData['birth_date'] ?? null,
                        'biography' => $actorData['biography'] ?? null,
                    ]);
                    $newActorCount++;
                } else {
                    // Update existing actor with any new information
                    $updateData = [];

                    // Only update if the field is provided and not empty
                    if (isset($actorData['profile_photo']) && !empty($actorData['profile_photo']) && $actor->profile_photo != $actorData['profile_photo']) {
                        $updateData['profile_photo'] = $actorData['profile_photo'];
                    }

                    if (isset($actorData['birth_date']) && !empty($actorData['birth_date']) && $actor->birth_date != $actorData['birth_date']) {
                        $updateData['birth_date'] = $actorData['birth_date'];
                    }

                    if (isset($actorData['biography']) && !empty($actorData['biography']) && $actor->biography != $actorData['biography']) {
                        $updateData['biography'] = $actorData['biography'];
                    }

                    // Update the actor if there are changes
                    if (!empty($updateData)) {
                        $actor->update($updateData);
                    }
                }

                // Create relationship with character name if provided
                $pivotData = [];
                if (isset($actorData['character']) && !empty($actorData['character'])) {
                    $pivotData['character'] = $actorData['character'];
                }

                // Add to the array of actors to sync
                $actorsToSync[$actor->id] = $pivotData;
            }

            // Sync all actors at once
            $movie->actors()->sync($actorsToSync);

            $message = "Movie updated successfully with {$actorCount} actors";
            if ($newActorCount > 0) {
                $message .= " ({$newActorCount} new actors created)";
            }
        }

        // Handle genres if provided
        if ($request->has('genres') && is_array($request->genres)) {
            $genreCount = 0;
            $newGenreCount = 0;
            $genresToSync = [];

            foreach ($request->genres as $genreData) {
                $genreCount++;

                // Check if genre already exists by TMDB ID
                $genre = null;
                if (!empty($genreData['id'])) {
                    $genre = Genre::where('tmdb_id', $genreData['id'])->first();
                }

                if (!$genre) {
                    // Try to find by name as fallback
                    $genre = Genre::where('name', $genreData['name'])->first();
                }

                // Create new genre if not found
                if (!$genre) {
                    $genre = Genre::create([
                        'tmdb_id' => $genreData['id'] ?? null,
                        'name' => $genreData['name'],
                        'slug' => \Illuminate\Support\Str::slug($genreData['name']),
                    ]);
                    $newGenreCount++;
                }

                // Add to the array of genres to sync
                $genresToSync[] = $genre->id;
            }

            // Sync all genres at once
            $movie->genres()->sync($genresToSync);
        }

        // Handle directors if provided
        if ($request->has('directors') && is_array($request->directors)) {
            // Instead of detaching all directors and then reattaching them,
            // we'll collect all directors and use sync at the end
            $directorCount = 0;
            $newDirectorCount = 0;
            $directorsToSync = [];

            foreach ($request->directors as $directorData) {
                $directorCount++;

                // Check if director already exists by TMDB ID
                $director = null;
                if (!empty($directorData['id'])) {
                    $director = Director::where('tmdb_id', $directorData['id'])->first();
                }

                if (!$director) {
                    // Try to find by name as fallback
                    $director = Director::where('name', $directorData['name'])->first();
                }

                // Create new director if not found
                if (!$director) {
                    $director = Director::create([
                        'tmdb_id' => $directorData['id'] ?? null,
                        'name' => $directorData['name'],
                        'profile_photo' => $directorData['profile_photo'] ?? null,
                        'biography' => $directorData['biography'] ?? null,
                    ]);
                    $newDirectorCount++;
                } else {
                    // Update existing director with any new information
                    $updateData = [];

                    // Only update if the field is provided and not empty
                    if (isset($directorData['profile_photo']) && !empty($directorData['profile_photo']) && $director->profile_photo != $directorData['profile_photo']) {
                        $updateData['profile_photo'] = $directorData['profile_photo'];
                    }

                    if (isset($directorData['biography']) && !empty($directorData['biography']) && $director->biography != $directorData['biography']) {
                        $updateData['biography'] = $directorData['biography'];
                    }

                    // Update the director if there are changes
                    if (!empty($updateData)) {
                        $director->update($updateData);
                    }
                }

                // Create relationship with job if provided
                $pivotData = [];
                if (isset($directorData['job']) && !empty($directorData['job'])) {
                    $pivotData['job'] = $directorData['job'];
                }

                // Add to the array of directors to sync
                $directorsToSync[$director->id] = $pivotData;
            }

            // Sync all directors at once
            $movie->directors()->sync($directorsToSync);
        }

        return redirect()->route('movie.index')
            ->with('success', 'Movie updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movie.index')
            ->with('success', 'Movie deleted successfully.');
    }


}

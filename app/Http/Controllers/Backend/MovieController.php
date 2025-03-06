<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'imdb_rating' => 'nullable|numeric|min:0|max:10',
            'country' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'type' => 'required|in:movie,tv_series',
            'maturity_rating' => 'nullable|in:G,PG,PG-13,R,NC-17',
            'is_free' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->route('movie.create')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Handle file uploads if present (for future implementation)

        Movie::create($request->all());

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
        $movie = Movie::findOrFail($id);
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
        $movie = Movie::findOrFail($id);
        return view('backend.movie.edit', compact('movie'));
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
            'imdb_rating' => 'nullable|numeric|min:0|max:10',
            'country' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'type' => 'required|in:movie,tv_series',
            'maturity_rating' => 'nullable|in:G,PG,PG-13,R,NC-17',
            'is_free' => 'boolean',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->route('movie.edit', $id)
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Handle file uploads if present (for future implementation)

        $movie->update($request->all());

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

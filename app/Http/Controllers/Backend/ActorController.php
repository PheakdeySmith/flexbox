<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Actor::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        $actors = $query->with('movies')->latest()->get();
        $movies = Movie::all();

        // If it's an AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($actors);
        }

        return view('backend.actor.index', compact('actors', 'movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.actor.create');
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
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'profile_photo' => 'nullable|string|max:255',
            'movies' => 'nullable|array',
            'movies.*' => 'exists:movies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('actor.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        $actor = Actor::create([
            'name' => $request->name,
            'biography' => $request->biography,
            'birth_date' => $request->birth_date,
            'profile_photo' => $request->profile_photo,
        ]);

        // Attach movies if selected
        if ($request->has('movies') && is_array($request->movies)) {
            foreach ($request->movies as $movieId) {
                $actor->movies()->attach($movieId);
            }
        }

        return redirect()->route('actor.index')
            ->with('success', 'Actor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = Actor::with('movies')->findOrFail($id);
        return view('backend.actor.show', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        $movies = Movie::all();
        return view('backend.actor.edit', compact('actor', 'movies'));
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
        // If actor_id is provided in the request, use it instead of the route parameter
        $actorId = $request->actor_id ?? $id;
        $actor = Actor::findOrFail($actorId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'profile_photo' => 'nullable|string|max:255',
            'movies' => 'nullable|array',
            'movies.*' => 'exists:movies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('actor.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        $actor->update([
            'name' => $request->name,
            'biography' => $request->biography,
            'birth_date' => $request->birth_date,
            'profile_photo' => $request->profile_photo,
        ]);

        // Sync movies if provided
        if ($request->has('movies')) {
            $actor->movies()->sync($request->movies);
        }

        return redirect()->route('actor.index')
            ->with('success', 'Actor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);

        // Delete the actor record
        $actor->delete();

        return redirect()->route('actor.index')
            ->with('success', 'Actor deleted successfully.');
    }
}

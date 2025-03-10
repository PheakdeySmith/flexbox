<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        $actors = $query->latest()->get();

        // If it's an AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($actors);
        }

        return view('backend.actor.index', compact('actors'));
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
        ]);

        if ($validator->fails()) {
            return redirect()->route('actor.create')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Handle file uploads if present (for future implementation)

        Actor::create($request->all());

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
        $actor = Actor::findOrFail($id);
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
        return view('backend.actor.edit', compact('actor'));
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
        $actor = Actor::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'profile_photo' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('actor.edit', $id)
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Handle file uploads if present (for future implementation)

        $actor->update($request->all());

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
        $actor->delete();

        return redirect()->route('actor.index')
            ->with('success', 'Actor deleted successfully.');
    }
}

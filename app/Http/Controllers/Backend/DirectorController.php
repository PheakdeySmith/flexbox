<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Director::query();

        // Search functionality (optional)
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        $directors = $query->with('movies')->latest()->get();
        $movies = Movie::all();

        // If it's an AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($directors);
        }

        return view('backend.director.index', compact('directors', 'movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view('backend.director.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'movies' => 'nullable|array',
            'movies.*' => 'exists:movies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('director.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Handle the profile photo upload
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $director = Director::create([
            'name' => $request->name,
            'biography' => $request->biography,
            'profile_photo' => $profilePhotoPath,
        ]);

        // Attach movies if selected
        if ($request->has('movies')) {
            $director->movies()->attach($request->movies);
        }

        return redirect()->route('director.index')->with('success', 'Director created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $director = Director::with('movies')->findOrFail($id);
        return view('backend.director.show', compact('director'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $director = Director::findOrFail($id);
        $movies = Movie::all();
        return view('backend.director.edit', compact('director', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $director = Director::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'movies' => 'nullable|array',
            'movies.*' => 'exists:movies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('director.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There were errors in your submission.');
        }

        // Handle the profile photo update
        $profilePhotoPath = $director->profile_photo;
        if ($request->hasFile('profile_photo')) {
            if ($director->profile_photo) {
                Storage::disk('public')->delete($director->profile_photo);
            }
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $director->update([
            'name' => $request->name,
            'biography' => $request->biography,
            'profile_photo' => $profilePhotoPath,
        ]);

        // Sync movies if provided
        if ($request->has('movies')) {
            $director->movies()->sync($request->movies);
        }

        return redirect()->route('director.index')->with('success', 'Director updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $director = Director::findOrFail($id);

        // Delete the profile photo if it exists
        if ($director->profile_photo) {
            Storage::disk('public')->delete($director->profile_photo);
        }

        $director->delete();
        return redirect()->route('director.index')->with('success', 'Director deleted successfully.');
    }
}

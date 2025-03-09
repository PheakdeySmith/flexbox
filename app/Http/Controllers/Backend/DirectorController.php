<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directors = Director::all();
        $movies = Movie::all();
        return view('backend.director.index',compact('directors', 'movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.director.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        Director::create([
            'name' => $request->name,
            'biography' => $request->biography,
            'profile_photo' => $profilePhotoPath,
        ]);

        return redirect()->route('director.index')->with('success', 'Director added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  /**
 * Show the form for editing the specified resource.
 */
public function edit(string $id)
{
    // Find the director by ID
    $director = Director::findOrFail($id);

    // Return the edit view with the director's data
    return view('backend.director.edit', compact('director'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'biography' => 'nullable|string',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the director by ID
    $director = Director::findOrFail($id);

    // Handle the profile photo upload, if a new file is uploaded
    if ($request->hasFile('profile_photo')) {
        // Delete the old profile photo if it exists
        if ($director->profile_photo) {
            Storage::disk('public')->delete($director->profile_photo);
        }

        // Store the new profile photo
        $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
    } else {
        // Keep the existing profile photo if no new file is uploaded
        $profilePhotoPath = $director->profile_photo;
    }

    // Update the director record
    $director->update([
        'name' => $request->name,
        'biography' => $request->biography,
        'profile_photo' => $profilePhotoPath,
    ]);

    // Redirect to the directors list with a success message
    return redirect()->route('director.index')->with('success', 'Director updated successfully.');
}


/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    // Find the director by ID
    $director = Director::findOrFail($id);

    // Delete the profile photo if it exists
    if ($director->profile_photo) {
        Storage::disk('public')->delete($director->profile_photo);
    }

    // Delete the director record
    $director->delete();

    // Redirect to the directors list with a success message
    return redirect()->route('director.index')->with('success', 'Director deleted successfully.');
}

}

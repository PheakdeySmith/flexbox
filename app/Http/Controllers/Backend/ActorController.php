<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::all();
        return view('backend.actor.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $actor = new Actor();
        return view('backend.actor.create', compact('actor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info('Actor store request received:', $request->all());

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'profile_photo' => 'nullable',
            'birth_date' => 'required|date',
        ]);

        // Check if the file is uploaded
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo'); // Get the uploaded file
            Log::info('File uploaded:', [
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $file->getPathname(),
                'mime_type' => $file->getMimeType(),
            ]);

            $filename = time() . '.' . $file->getClientOriginalExtension(); // Generate unique file name
            $file->move(public_path('uploads/actors'), $filename); // Move file to public/uploads/actors

            Log::info('File successfully moved to uploads/actors directory.', [
                'filename' => $filename
            ]);
        } else {
            $filename = 'default.jpg'; // If no file is uploaded, use default image
            Log::info('No file uploaded, using default image.');
        }

        // Store actor in database
        Actor::create([
            'name' => $request->name,
            'biography' => $request->biography,
            'profile_photo' => $filename, // Save file name in DB
            'birth_date' => $request->birth_date,
        ]);

        // Log successful creation
        Log::info('Actor created successfully:', [
            'name' => $request->name,
            'biography' => $request->biography,
            'profile_photo' => $filename,
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('actor.index')->with('success', 'Actor added successfully!');
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
    public function edit(string $id)
    {
        $actor = Actor::findOrFail($id);
        return view('backend.actor.edit', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Retrieve the actor by ID
        $actor = Actor::findOrFail($id);

        // Update the actor's data
        $actor->name = $validated['name'];
        $actor->biography = $validated['biography'];

        // Handle file upload if there is a new profile photo
        if ($request->hasFile('profile_photo')) {
            // Delete the old image if it exists
            if ($actor->profile_photo) {
                Storage::delete($actor->profile_photo);
            }

            // Store the new image and save the path
            $path = $request->file('profile_photo')->store('actors');
            $actor->profile_photo = $path;
        }

        // Save the updated actor
        $actor->save();

        // Redirect to the actor list or show a success message
        return redirect()->route('actor.index')->with('success', 'Actor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Retrieve the actor by ID
        $actor = Actor::findOrFail($id);

        // Delete the actor's profile photo if it exists
        if ($actor->profile_photo) {
            Storage::delete($actor->profile_photo);
        }

        // Delete the actor from the database
        $actor->delete();

        // Redirect to the actor list or show a success message
        return redirect()->route('actor.index')->with('success', 'Actor deleted successfully!');
    }


}

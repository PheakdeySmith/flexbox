<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin,moderator',
            'user_profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('user_profile')) {
            $imagePath = $request->file('user_profile')->store('user_profile', 'public');
        }

        // Create User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'user_profile' => $imagePath,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    public function front_edit(Request $request)
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Pass the user details to the frontend view
        return view('frontend.account.index', compact('user'));
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the user or fail
            $user = User::findOrFail($id);

            // Validate the input data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'user_profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);

            // Check if a new password is provided
            if ($request->has('new_password') && $request->new_password) {
                // Validate the current password
                if (!Hash::check($request->password, $user->password)) {
                    return redirect()->back()->with('error', 'The current password is incorrect.');
                }

                // Validate the new password and confirmation
                $request->validate([
                    'new_password' => 'required|min:6',
                    'new_password_confirmation' => 'required|same:new_password',
                ]);

                // Update the password if the new one is provided
                $user->password = Hash::make($request->new_password);
            }

            // Handle the profile image upload if a new file is provided
            if ($request->hasFile('user_profile')) {
                // Delete the old profile image if it exists
                if ($user->user_profile && Storage::disk('public')->exists($user->user_profile)) {
                    Storage::disk('public')->delete($user->user_profile);
                }

                // Store the new profile image
                $user->user_profile = $request->file('user_profile')->store('user_profile', 'public');
            }

            // Update user details (name, email)
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Redirect after successful update
            $redirectRoute = $request->has('from_frontend') ? 'frontend.account' : 'user.index';
            return Redirect::route($redirectRoute)->with('success', 'User updated successfully.');

            return Redirect::route($redirectRoute)->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for better debugging
            Log::error('Error updating user: ' . $e->getMessage());
            Log::error('Error updating user: ' . $e->getMessage());

            // Return with an error message
            return redirect()->back()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the profile photo if it exists
        if ($user->user_profile) {
            Storage::disk('public')->delete($user->user_profile);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}

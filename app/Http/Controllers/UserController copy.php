<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('backend.user.index', compact('users', 'roles'));
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
            'role' => 'required|exists:roles,name', // Use Spatie roles
            'user_profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Handle File Upload
        $imagePath = null;
        if ($request->hasFile('user_profile')) {
            $imagePath = $request->file('user_profile')->store('user_profile', 'public');
        }

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_profile' => $imagePath,
        ]);

        // Assign Role (Fix)
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'user_profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('user_profile')) {
            // Delete old image if exists
            if ($user->user_profile) {
                Storage::disk('public')->delete($user->user_profile);
            }
            $user->user_profile = $request->file('user_profile')->store('user_profile', 'public');
        }

        // Update User
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'user_profile' => $user->user_profile, // Make sure user_profile is updated
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
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

    /**
     * Display the specified user.
     */
    public function show(User $user): View|RedirectResponse
    {
        try {
            $user->load(['movie' => function ($query) {
                $query->withTrashed();
            }, 'user']);
            return view('backend.user.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Failed to show user:', ['error' => $e->getMessage(), 'user_id' => $user->id]);
            return redirect()->route('user.index')->with('error', 'Failed to load user details.');
        }
    }
}

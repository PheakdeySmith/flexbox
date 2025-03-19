<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $roles = Role::all();

        // Handle search functionality
        $search = $request->input('search');

        $usersQuery = User::query();

        // Apply search filter if search parameter exists
        if ($search) {
            $usersQuery->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $users = $usersQuery->paginate(10);

        // If search parameter exists, append it to the pagination links
        if ($search) {
            $users->appends(['search' => $search]);
        }

        return view('backend.user.index', compact('users', 'roles', 'search'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        return view('backend.user.create');
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,id',  // Validate role ID exists in the roles table
            'user_profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',  // Validate image
        ]);

        $imagePath = null;
        if ($request->hasFile('user_profile')) {
            $imagePath = Storage::url($request->file('user_profile')->store('profile-photos', 'public'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_profile' => $imagePath,
        ]);

        $role = Role::findById($request->role);
        $user->assignRole($role->name);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified user.
     */
    public function show($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $user = User::findOrFail($id);
        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        // Get the user's current role name to properly show in dropdown
        $userRole = $user->roles->first();
        return view('backend.user.edit', compact('user', 'roles', 'userRole'));
    }

    public function front_edit(Request $request)
    {
        $orders = \App\Models\Order::with(['items.movie', 'paymentDetail.payment'])
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->get();
        // Get the currently authenticated user
        $user = $request->user();

        // Pass the user details to the frontend view
        return view('frontend.account.index', compact('user', 'orders'));
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
                'role' => 'required|exists:roles,id',
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

                $user->password = Hash::make($request->new_password);
            }

            if ($request->hasFile('user_profile')) {
                if ($user->user_profile && Storage::disk('public')->exists($user->user_profile)) {
                    Storage::disk('public')->delete($user->user_profile);
                }

                $user->user_profile = Storage::url($request->file('user_profile')->store('profile-photos', 'public'));
            }

            // Update basic user information
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update role - first remove existing roles then assign new role
            $user->syncRoles([]);  // Remove all current roles
            $role = Role::findById($request->role);
            $user->assignRole($role);

            $redirectRoute = $request->has('from_frontend') ? 'frontend.account' : 'user.index';
            return redirect()->route($redirectRoute)->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    public function updateFrontend(Request $request, $id)
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

        // Check if current password is provided and new password fields are filled
        if ($request->filled('password')) {
            // Ensure both new_password and new_password_confirmation are filled
            if (!$request->filled('new_password') || !$request->filled('new_password_confirmation')) {
                return redirect()->back()->with('error', 'Both new password and confirmation are required.');
            }

            // Validate the current password
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->with('error', 'The current password is incorrect.');
            }

            // Validate new password and confirmation
            $request->validate([
                'new_password' => 'required|min:6',
                'new_password_confirmation' => 'required|same:new_password',
            ]);

            $user->password = Hash::make($request->new_password);
        }

        if ($request->hasFile('user_profile')) {
            if ($user->user_profile && Storage::disk('public')->exists($user->user_profile)) {
                Storage::disk('public')->delete($user->user_profile);
            }

            $user->user_profile = Storage::url($request->file('user_profile')->store('profile-photos', 'public'));
        }

        // Update basic user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('frontend.account')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        Log::error('Error updating user: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
    }
}


    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $user = User::findOrFail($id);

        if ($user->user_profile) {
            Storage::disk('public')->delete($user->user_profile);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    // Return logged-in user
    public function profile()
    {
        return response()->json(Auth::user());
    }

// Update profile picture
public function updateProfilePic(Request $request) {
    $request->validate([
        'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('profile_pic')) {
        // Store the file in storage/app/public/profile_pics
        $path = $request->file('profile_pic')->store('profile_pics', 'public');

        // Save the accessible path in the database
        $user->profile_pic = asset('storage/' . $path);
        $user->save();
    }

    return response()->json([
        'message' => 'Profile picture updated successfully',
        'profile_pic' => $user->profile_pic
    ]);
}

    // Update user name
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return response()->json(['message' => 'Name updated successfully']);
    }

    // Update user email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'Email updated successfully']);
    }


    // Change password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

    // Delete account
    public function deleteAccount()
    {
        $user = Auth::user();
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }
}
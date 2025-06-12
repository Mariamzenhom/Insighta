<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'role' => $user->role,
            ]
        ], 200);
    }


    /**
     * Update the user's profile information.
     */

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $user = $request->user();
            $user->name = $request->name;
            $user->save();

            return response()->json([
                'message' => 'Name updated successfully.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
                    'role' => $user->role,
                ]
            ], 200);


        } catch (\Exception $e) {
            Log::error('Name update failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to update name. Please try again later.'
            ], 500);
        }
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048' // 2MB Max
        ]);

        try {
            $user = $request->user();

            // احذف الصورة القديمة لو فيه
            if ($user->avatar) {
                \Storage::disk('public')->delete($user->avatar);
            }

            // خزن الصورة الجديدة
            $path = $request->file('avatar')->store('avatars', 'public');

            $user->avatar = $path;
            $user->save();

            return response()->json([
                'message' => 'Avatar updated successfully.',
                'avatar_url' => asset('storage/' . $path),
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
                    'role' => $user->role,
                ]
            ], 200);


        } catch (\Exception $e) {
            \Log::error('Avatar update failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to update avatar. Please try again later.'
            ], 500);
        }
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        // Validate current password
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

            // Delete all personal access tokens (for Sanctum)
            $user->tokens()->delete();

            // Log out the user before deleting
            Auth::guard('web')->logout();

            // Delete user account
            $user->delete();

            return response()->json([
                'message' => 'Account deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Account deletion failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to delete account. Please try again later.'
            ], 500);
        }
    }

}

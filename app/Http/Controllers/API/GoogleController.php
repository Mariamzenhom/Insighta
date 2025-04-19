<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class GoogleController extends Controller
{
    use HasApiTokens;
    public function redirectToGoogle()
    {

        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleGoogleCallback()
    {

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('social_id', $googleUser->id)->first();

            if ($user) {
                // Update user details
                $user->google_token = $googleUser->google_token;

            } else {
                // Create a new user
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'social_id' => $googleUser->id,
                    'social_type' => 'google',
                    'password' => Hash::make('random_password')
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User authenticated successfully',
                'user' => $user,
                'token' => $token
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

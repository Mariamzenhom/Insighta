<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class FacebookController extends Controller
{
    use HasApiTokens;
    public function redirectToFacebook()
    {

        return response()->json([
            'url' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleFacebookCallback()
    {

        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::where('email', $facebookUser->email)->first();

            if ($user) {
                // Update user details
                $user->facebook_token = $facebookUser->token;
              	$user->save();

            } else {
                // Create a new user
                $userData = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'social_id' => $facebookUser->id,
                    'social_type' => 'facebook',
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

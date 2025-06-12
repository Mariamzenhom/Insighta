<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{
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
                $user->social_id = $facebookUser->id;
                $user->social_type = 'facebook';
              	$user->role = 'user',
                $user->save();
            } else {
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'social_id' => $facebookUser->id,
                  	 'role' = 'user',
                    'social_type' => 'facebook',
                    'password' => Hash::make(uniqid()) // أكثر أمانًا من 'random_password'
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $token
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Authentication failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}



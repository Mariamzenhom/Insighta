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

            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('random_password'),
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User authenticated successfully',
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate user', 'details' => $e->getMessage()], 500);
        }
    }

}


// namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
// use Laravel\Socialite\Facades\Socialite;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class GoogleController extends Controller
// {
//     private function configureGoogleDriver()
//     {
//         $config = config("services.google");

//         if (!$config || !isset($config['client_id']) || !isset($config['client_secret']) || !isset($config['redirect'])) {
//             throw new \Exception("Google API config is missing or incomplete.");
//         }
//     }

//     public function redirectToGoogle()
//     {
//         try {
//             $this->configureGoogleDriver();
//             return response()->json([
//                 'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
//             ]);
//         } catch (\Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

//     public function handleGoogleCallback()
//     {
//         try {
//             $this->configureGoogleDriver();
//             $socialiteUser = Socialite::driver('google')->stateless()->user();

//             $existingUser = User::where('email', $socialiteUser->email)->first();

//             if ($existingUser) {
//                 if (is_null($existingUser->google_id)) {
//                     $existingUser->google_id = $socialiteUser->id;
//                     $existingUser->save();
//                 }

//                 Auth::login($existingUser);
//                 $token = $existingUser->createToken('GoogleAuthToken')->plainTextToken;

//                 return response()->json([
//                     'status' => true,
//                     'message' => 'Login successful.',
//                     'token' => $token,
//                     'user' => [
//                         'id' => $existingUser->id,
//                         'name' => $existingUser->name,
//                         'email' => $existingUser->email,
//                     ]
//                 ], 200);
//             } else {
//                 $newUser = User::create([
//                     'name' => $socialiteUser->name,
//                     'email' => $socialiteUser->email,
//                     'google_id' => $socialiteUser->id,
//                     'password' => Hash::make('random_secure_password')
//                 ]);

//                 Auth::login($newUser);
//                 $token = $newUser->createToken('GoogleAuthToken')->plainTextToken;

//                 return response()->json([
//                     'status' => true,
//                     'message' => 'Registered successfully.',
//                     'token' => $token,
//                     'user' => [
//                         'id' => $newUser->id,
//                         'name' => $newUser->name,
//                         'email' => $newUser->email,
//                     ]
//                 ], 200);
//             }
//         } catch (\Throwable $th) {
//             return response()->json([
//                 'status' => false,
//                 'message' => $th->getMessage(),
//             ], 500);
//         }
//     }
// }

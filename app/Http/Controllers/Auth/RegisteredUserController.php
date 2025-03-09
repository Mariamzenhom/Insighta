<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserProfileResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Create User
     * @param Request $request
     * @return User
     */

    public function registerUser(Request $request)
    {
        try {
            $viladateUser = Validator::make(
                $request->all(),
                [
                    "name" => "required",
                    "email" => "required|email|unique:users,email",
                    "password" => "required|min:6",
                ]
            );

            if ($viladateUser->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "errors" => $viladateUser->errors()
                ], 401);
            }

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

            $otp = rand(10000, 99999);
            Cache::put('otp', $otp, now()->addMinutes(10));

            Mail::to($user->email)->send(new SendOtpMail($otp));

            return response()->json([
                "status" => true,
                "message" => "User created successfully",
                "token" => $user->createToken("API TOKEN")->plainTextToken,
                "otp_message" => "Code sent successfully"
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => "User creation failed",
            ], 500);
        }
    }
}
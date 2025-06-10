<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Verifytoken;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        // إضافة قاعدة التحقق من DNS كقاعدة مخصصة
        Validator::extend('dns_email', function ($attribute, $value, $parameters, $validator) {
            $domain = substr(strrchr($value, "@"), 1);
            return checkdnsrr($domain, 'MX') || checkdnsrr($domain, 'A');
        }, 'The :attribute must have a valid email domain.');
    }

    public function create(): View
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    "name" => "required|string|max:255",
                    "email" => "required|email|unique:users,email|dns_email",
                    "password" => [
                        "required",
                        Password::min(8)
                            ->mixedCase()
                            ->numbers()
                            ->symbols(),
                        "confirmed",
                    ],

                    "role" => "required|string|in:user,child,parent",
                ]
            );


            if ($validateUser->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "errors" => $validateUser->errors()
                ], 422);
            }

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
              	'email_verified_at' => now(),
                "role" => $request->role,
                "is_activated" => 1,
            ]);


            return response()->json([
                "status" => true,
                "message" => 'User registered successfully. You can now log in.',
                "token" => $user->createToken("API TOKEN")->plainTextToken,
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }
  
}


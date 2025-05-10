<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Verifytoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


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
                    'role' => 'required|string',
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
                "password" => Hash::make($request->password),
                "role" => $request->role,
            ]);

            $validToken = rand(10000, 99999);
            $get_token = new Verifytoken();
            $get_token->email = $user['email'];
            $get_token->token = $validToken;
            $get_token->save();
            $get_user_email = $user['email'];
            $get_user_name = $user['name'];
            Mail::to($user->email)->send(new WelcomeMail($get_user_name, $get_user_email, $validToken));

            return response()->json([
                "status" => true,
                "message" => "User created successfully",
                "token" => $user->createToken("API TOKEN")->plainTextToken,
                "Verification Code" => "Code sent successfully"
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyAccount(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $tokenData = Verifytoken::where('token', $request->token)->first();

        if (!$tokenData) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Code.'
            ], 404);
        }

        $user = User::where('email', $tokenData->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $user->is_activated = 1;
        $user->email_verified_at = now();
        $user->save();

        //Delete the token after activation
        $tokenData->delete();

        return response()->json([
            'status' => true,
            'message' => 'Your account has been activated successfully.'
        ], 200);
    }


}

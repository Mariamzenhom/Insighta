<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */

     public function createUser(Request $request) {
        try {
            $viladateUser = Validator::make($request->all(), 
        [
            "name"=> "required",
            "email"=> "required|email|unique:users,email",
            "password"=> "required|min:6",
            ]);

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

            return response()->json([
                "status" => true,
                "message" => "User created successfully",
                "token" => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
            
        } catch (\Throwable $e) {
            return response()->json([
                "status"=> false,
                "message"=> "User creation failed",
            ], 500);    
        }
    }

    /**
     * Login User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request) {
        try {
            $validateUser = Validator::make($request->all(),
             [
                "email" => "required|email",
                "password" => "required"
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "errors" => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only("email","password"))) {
                return response()->json([
                    "status" => false,
                    "message" => "Email & Password do not match"
                ], 401);
            }

            $user = User::where("email", $request->email)->first();

            return response()->json([
                "status" => true,
                "message" => "User logged in successfully",
                "token" => $user->createToken("API TOKEN")->plainTextToken
                ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }
    }
}

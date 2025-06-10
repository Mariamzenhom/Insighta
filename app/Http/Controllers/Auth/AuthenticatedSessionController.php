<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Services\NotificationService;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    "email" => "required|email",
                    "password" => "required"
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Validation Error",
                    "errors" => $validateUser->errors()
                ], 401);
            }

            $remember = $request->has("remember");

            $user = User::where("email", $request->email)->first();

            if (!$user || !Auth::attempt($request->only("email", "password"), $remember)) {
                return response()->json([
                    "status" => false,
                    "message" => "Email or password is incorrect."
                ], 401);
            }

   
            // 🔔 Notification on successful login
            $notificationService = new NotificationService();
            $notificationService->sendNotification(
                $user->id,
                'Login Successful',
                'You have successfully logged in to your account.'
            );

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

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully.'
        ], 200);
    }
}

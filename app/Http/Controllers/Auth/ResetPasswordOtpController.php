<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Services\NotificationService;

class ResetPasswordOtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));

        Mail::raw("Your password reset code is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Password Reset Code');
        });

        return response()->json([
            'message' => 'Verification code has been sent to your email.'
        ]);
    }



    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
        ]);

        $cachedOtp = Cache::get('otp_' . $request->email);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json([
                'message' => 'Invalid or expired OTP.'
            ], 422);
        }

        // حطينا فلاج إنه فعّل OTP
        Cache::put('otp_verified_' . $request->email, true, now()->addMinutes(10));

        return response()->json([
            'message' => 'OTP has been verified successfully.'
        ]);
    }
  
  	public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $cachedOtp = Cache::get('otp_' . $request->email);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json([
                'message' => 'Invalid or expired OTP.'
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        Cache::forget('otp_' . $request->email);
        Cache::forget('otp_verified_' . $request->email); // احتياطي لو كنتي بتستخدميه

        (new NotificationService())->sendNotification(
            $user->id,
            'Password Changed',
            'Your password has been successfully updated.'
        );

        return response()->json([
            'message' => 'Password has been successfully changed.'
        ]);
    }


}

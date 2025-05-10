<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class ResetPasswordOtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);

        // خزّن OTP لمدة 5 دقايق
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(5));

        // إرسال الإيميل
        Mail::raw("كود التحقق الخاص بك هو: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('كود إعادة تعيين كلمة المرور');
        });

        return response()->json([
            'message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني.'
        ]);
    }

    public function verifyOtpAndReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $cachedOtp = Cache::get('otp_' . $request->email);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json(['message' => 'OTP غير صحيح أو منتهي الصلاحية.'], 422);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        // حذف الكاش بعد الاستخدام
        Cache::forget('otp_' . $request->email);

        return response()->json([
            'message' => 'تم تغيير كلمة المرور بنجاح.'
        ]);
    }
}


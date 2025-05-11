<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialMediaUsage;
use Illuminate\Http\Request;
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
  	
  	public function startUsage(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $usage = SocialMediaUsage::create([
                'user_id' => $user->id,
                'platform' => 'facebook',
                'start_time' => now(),
            ]);

            return response()->json([
                'message' => 'Facebook usage started',
                'usage_id' => $usage->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

  
  	// FacebookController.php

    public function endUsage(Request $request)
    {
        $user = auth()->user();
        $platform = 'facebook'; // بتستخدم الـ platform الفعلي هنا
        $duration = $request->input('duration_seconds'); // مدة الجلسة (بالثواني)

        // جلب قيمة الـ threshold من config
        $warningThreshold = 30 * 60; 

        // لو المدة أكبر من الـ threshold، أرسل التحذير
        if ($duration >= $warningThreshold) {
            $this->sendSmartWarning($user, $platform, $duration);
        }

        // تحديد الـ social media usage session
        $usage = SocialMediaUsage::where('user_id', $user->id)
            ->where('platform', $platform)
            ->whereNull('end_time')
            ->latest()
            ->first();

        if ($usage) {
            // تحديث وقت النهاية ومدة الجلسة بالثواني
            $usage->end_time = now();
            $usage->duration_seconds = $duration;
            $usage->save();
        }

        return response()->json([
            'message' => 'Facebook usage ended successfully',
        ]);
    }

	protected function sendSmartWarning($user, $platform, $duration)
  {
      $minutes = round($duration / 60); // تحويل المدة لدقائق

      // إعداد رسالة التحذير فقط بدون التوصيات
      $warningMessage = "⚠️ قضيت $minutes دقيقة على $platform! محتاج بريك؟";

      // إرسال الإشعار للمستخدم
      $user->notify(new \App\Notifications\SmartWarningNotification([
          'message' => $warningMessage,
      ]));
  }

}

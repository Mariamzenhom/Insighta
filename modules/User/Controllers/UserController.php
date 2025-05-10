<?php

declare(strict_types=1);

namespace Modules\User\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Handlers\DeleteUserHandler;
use Modules\User\Handlers\UpdateUserHandler;
use Modules\User\Requests\GetUserOtpRequest;
use Modules\User\Requests\GetUserRequest;
use Modules\User\Services\UserCRUDService;

class UserController extends Controller
{
    public function __construct(
        private UserCRUDService $userService,
    ) {
    }


    public function showSelectChildPage()
    {
        return view('user::select-child'); // Point this to your Blade file
    }

    // Handle the OTP sending logic when a parent selects a child
    public function selectChildAndSendOtp(GetUserRequest $request)
    {
        $this->userService->sendOtp($request);

        // Redirect to the OTP verification page with a success message
        return redirect()->route('child.verifyOtp')->with('message', 'OTP sent successfully to the child email.');
    }

    // Show the form to verify OTP
    public function showVerifyOtpPage()
    {
        return view('user::verify-otp'); // Point this to your Blade file
    }

    // Handle OTP verification when the child submits it
    public function verifyOtp(GetUserOtpRequest $request)
    {

       $verifyOtp = $this->userService->verifyOtp($request);


        if ($verifyOtp) {
            return redirect()->route('dashboard')->with('message', 'Email verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }
}

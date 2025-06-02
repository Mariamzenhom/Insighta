<?php

declare(strict_types=1);

namespace Modules\User\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Js;
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
    public function selectChildAndSendOtp(GetUserRequest $request)
    {
        $this->userService->sendOtp($request);
        return Json::success('OTP sent successfully to the child email.');
    }

    public function verifyOtp(GetUserOtpRequest $request)
    {

       $verifyOtp = $this->userService->verifyOtp($request);

        if ($verifyOtp) {
            return Json::success('Email verified successfully!');

        }
        return Json::error('Invalid or expired OTP');
    }
}

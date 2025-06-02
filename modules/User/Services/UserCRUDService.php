<?php

declare(strict_types=1);

namespace Modules\User\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Modules\User\DTO\CreateUserDTO;
use Modules\User\Repositories\UserRepository;
use Ramsey\Uuid\UuidInterface;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class UserCRUDService
{
    public function __construct(
        private UserRepository $repository,
    ) {
    }

    public function create(CreateUserDTO $createUserDTO): User
    {
         return $this->repository->createUser($createUserDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): User
    {
        return $this->repository->getUser(
            id: $id,
        );
    }
    public function sendOtp($request){
        $child = User::where('email', $request->input('child_email'))->first();

        $otp = rand(100000, 999999);
        $child->otp = $otp;
        $child->otp_expires_at = now()->addMinutes(10);
        $child->save();

        Mail::to($child->email)->send(new OtpMail($otp));
    }

    public function verifyOtp($request)
    {
        $otp = $request->input('otp');

        $child = User::where('otp', $otp)->first();

        if (!$child) {
            return false;
        }

        $parent = auth()->user();

        $parent->update(['child_id' => $child->id]);

                if ($otp == $child->otp && $child->otp_expires_at > now()) {
            $child->email_verified_at = now();
            $child->save();

            return true;
        }
        return false;

    }
}

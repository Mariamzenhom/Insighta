<?php

declare(strict_types=1);

namespace Modules\TherapySession\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Modules\Therapist\Models\Therapist;
use Modules\TherapySession\DTO\CreateTherapySessionDTO;
use Modules\TherapySession\Models\TherapySession;
use Modules\TherapySession\Repositories\TherapySessionRepository;
use Ramsey\Uuid\UuidInterface;

class TherapySessionCRUDService
{
    public function __construct(
        private TherapySessionRepository $repository,
    ) {
    }
    public function create(CreateTherapySessionDTO $createTherapySessionDTO): TherapySession
    {
         return $this->repository->createTherapySession($createTherapySessionDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        $user = auth()->user()->role ;

        if($user == 'child' ){
            $userId = auth()->user()->id;

        }elseif($user == 'parent'){
            $userId = auth()->user()->child_id;
        }else{
            return $this->repository->paginated(
                            page: $page,
                            perPage: $perPage,
                    );
        }

        return $this->repository->paginated(
            ['user_id' => $userId],
                    page: $page,
                    perPage: $perPage,
                );
    }

    public function get(UuidInterface $id): TherapySession
    {
        return $this->repository->getTherapySession(
            id: $id,
        );
    }
    public function exists(CreateTherapySessionDTO $createTherapySessionDTO )
    {
        $this->repository->exists($createTherapySessionDTO->toArray());
    }

        public function getUsers()
    {
        return User::get(); //where('role','admin')->
    }

    public function getTherapists()
    {
        return Therapist::with('user')->get();
    }
}

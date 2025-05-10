<?php

declare(strict_types=1);

namespace Modules\Therapist\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Modules\Therapist\DTO\CreateTherapistDTO;
use Modules\Therapist\Models\Therapist;
use Modules\Therapist\Repositories\TherapistRepository;
use Ramsey\Uuid\UuidInterface;

class TherapistCRUDService
{
    public function __construct(
        private TherapistRepository $repository,
    ) {
    }

    public function create(CreateTherapistDTO $createTherapistDTO): Therapist
    {
         return $this->repository->createTherapist($createTherapistDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Therapist
    {
        return $this->repository->getTherapist(
            id: $id,
        );
    }
    public function getUser()
    {
        return User::get();
    }
}

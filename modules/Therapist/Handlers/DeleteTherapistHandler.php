<?php

declare(strict_types=1);

namespace Modules\Therapist\Handlers;

use Modules\Therapist\Repositories\TherapistRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteTherapistHandler
{
    public function __construct(
        private TherapistRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteTherapist($id);
    }
}

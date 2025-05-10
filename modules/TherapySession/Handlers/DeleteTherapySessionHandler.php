<?php

declare(strict_types=1);

namespace Modules\TherapySession\Handlers;

use Modules\TherapySession\Repositories\TherapySessionRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteTherapySessionHandler
{
    public function __construct(
        private TherapySessionRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteTherapySession($id);
    }
}

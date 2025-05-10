<?php

declare(strict_types=1);

namespace Modules\TherapySession\Handlers;

use Modules\TherapySession\Commands\UpdateTherapySessionCommand;
use Modules\TherapySession\Repositories\TherapySessionRepository;

class UpdateTherapySessionHandler
{
    public function __construct(
        private TherapySessionRepository $repository,
    ) {
    }

    public function handle(UpdateTherapySessionCommand $updateTherapySessionCommand)
    {
        $this->repository->updateTherapySession($updateTherapySessionCommand->getId(), $updateTherapySessionCommand->toArray());
    }
}

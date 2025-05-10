<?php

declare(strict_types=1);

namespace Modules\Therapist\Handlers;

use Modules\Therapist\Commands\UpdateTherapistCommand;
use Modules\Therapist\Repositories\TherapistRepository;

class UpdateTherapistHandler
{
    public function __construct(
        private TherapistRepository $repository,
    ) {
    }

    public function handle(UpdateTherapistCommand $updateTherapistCommand)
    {
        $this->repository->updateTherapist($updateTherapistCommand->getId(), $updateTherapistCommand->toArray());
    }
}

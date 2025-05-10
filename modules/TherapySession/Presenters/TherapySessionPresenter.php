<?php

declare(strict_types=1);

namespace Modules\TherapySession\Presenters;

use Modules\TherapySession\Models\TherapySession;
use BasePackage\Shared\Presenters\AbstractPresenter;

class TherapySessionPresenter extends AbstractPresenter
{
    private TherapySession $therapySession;

    public function __construct(TherapySession $therapySession)
    {
        $this->therapySession = $therapySession;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->therapySession->id,
            'name' => $this->therapySession->name,
        ];
    }
}

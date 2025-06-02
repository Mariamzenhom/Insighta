<?php

declare(strict_types=1);

namespace Modules\TherapySession\Presenters;

use Modules\Therapist\Presenters\TherapistPresenter;
use Modules\TherapySession\Models\TherapySession;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\User\Presenters\UserPresenter;

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
             'user' => $this->therapySession->user ? (new UserPresenter($this->therapySession->user))->getData() : null,
            'user_id' => $this->therapySession->user_id,
            'session_time'  => $this->therapySession->session_time,
            'notes' => $this->therapySession->notes,
            'is_paid'=> $this->therapySession->is_paid,
            'therapist' => $this->therapySession->therapist? (new TherapistPresenter($this->therapySession->therapist))->getData() : null,
        ];
    }
}

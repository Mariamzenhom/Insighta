<?php

declare(strict_types=1);

namespace Modules\Therapist\Presenters;

use Modules\Therapist\Models\Therapist;
use BasePackage\Shared\Presenters\AbstractPresenter;

class TherapistPresenter extends AbstractPresenter
{
    private Therapist $therapist;

    public function __construct(Therapist $therapist)
    {
        $this->therapist = $therapist;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->therapist->id,
            'user' => $this->therapist->user,
            'specialty'=> $this->therapist->specialty,
            'rating'=> $this->therapist->rating,
            'price'=> $this->therapist->price,
        ];
    }
}

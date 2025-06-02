<?php

declare(strict_types=1);

namespace Modules\Therapist\Presenters;

use Modules\Therapist\Models\Therapist;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Shared\Media\Presenters\MediaPresenter;

class TherapistPresenter extends AbstractPresenter
{
    private Therapist $therapist;

    public function __construct(Therapist $therapist)
    {
        $this->therapist = $therapist;
    }

    protected function present(bool $isListing = false): array
    {
        $media = $this->therapist->getFirstMedia('therapist');

        return [
            'id' => $this->therapist->id,
            'name'=> $this->therapist->name,
            'email'=> $this->therapist->email,
            'phone'=> $this->therapist->phone,
            'specialty'=> $this->therapist->specialty,
            'rating'=> $this->therapist->rating,
            'price'=> $this->therapist->price,
            'file' => $media ? (new MediaPresenter($media))->getData() : null,

        ];
    }
}

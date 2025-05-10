<?php

declare(strict_types=1);

namespace Modules\Therapist\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Therapist\Models\Therapist;

/**
 * @property Therapist $model
 * @method Therapist findOneOrFail($id)
 * @method Therapist findOneByOrFail(array $data)
 */
class TherapistRepository extends BaseRepository
{
    public function __construct(Therapist $model)
    {
        parent::__construct($model);
    }

    public function getTherapistList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getTherapist(UuidInterface $id): Therapist
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createTherapist(array $data): Therapist
    {
        return $this->create($data);
    }

    public function updateTherapist(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteTherapist(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

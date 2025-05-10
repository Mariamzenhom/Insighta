<?php

declare(strict_types=1);

namespace Modules\TherapySession\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\TherapySession\Models\TherapySession;

/**
 * @property TherapySession $model
 * @method TherapySession findOneOrFail($id)
 * @method TherapySession findOneByOrFail(array $data)
 */
class TherapySessionRepository extends BaseRepository
{
    public function __construct(TherapySession $model)
    {
        parent::__construct($model);
    }

    public function getTherapySessionList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getTherapySession(UuidInterface $id): TherapySession
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createTherapySession(array $data): TherapySession
    {
        return $this->create($data);
    }

    public function updateTherapySession(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteTherapySession(UuidInterface $id): bool
    {
        return $this->delete($id);
    }

    public function exists(array $data )
    {
        $this->model->where('therapist_id', $data['therapist_id'])
                    ->where('session_time', $data['session_time'])
                    ->exists();
    }
}

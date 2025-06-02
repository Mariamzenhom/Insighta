<?php

declare(strict_types=1);

namespace Modules\TherapySession\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\TherapySession\Handlers\DeleteTherapySessionHandler;
use Modules\TherapySession\Handlers\UpdateTherapySessionHandler;
use Modules\TherapySession\Presenters\TherapySessionPresenter;
use Modules\TherapySession\Requests\CreateTherapySessionRequest;
use Modules\TherapySession\Requests\DeleteTherapySessionRequest;
use Modules\TherapySession\Requests\GetTherapySessionListRequest;
use Modules\TherapySession\Requests\GetTherapySessionRequest;
use Modules\TherapySession\Requests\UpdateTherapySessionRequest;
use Modules\TherapySession\Services\TherapySessionCRUDService;
use Ramsey\Uuid\Uuid;

class TherapySessionController extends Controller
{
    public function __construct(
        private TherapySessionCRUDService $therapySessionService,
        private UpdateTherapySessionHandler $updateTherapySessionHandler,
        private DeleteTherapySessionHandler $deleteTherapySessionHandler,
    ) {
    }

    public function index(GetTherapySessionListRequest $request): JsonResponse
    {
        $list = $this->therapySessionService->list(
                        (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(TherapySessionPresenter::collection($list['data']), paginationSettings: $list['pagination']);

    }

    public function store(CreateTherapySessionRequest $request): JsonResponse
    {
        $createdItem = $this->therapySessionService->create($request->createDTO());

        $presenter = new TherapySessionPresenter($createdItem);

        return Json::item($presenter->getData());
    }
    public function show(GetTherapySessionRequest $request): JsonResponse
    {
        $item = $this->therapySessionService->get(Uuid::fromString($request->route('id')));

        $presenter = new TherapySessionPresenter($item);

        return Json::item($presenter->getData());
    }
    public function update(UpdateTherapySessionRequest $request): JsonResponse
    {
        $command = $request->createUpdateTherapySessionCommand();
        $this->updateTherapySessionHandler->handle($command);

        $item = $this->therapySessionService->get($command->getId());

        $presenter = new TherapySessionPresenter($item);

        return Json::item($presenter->getData());
    }

    public function destroy(DeleteTherapySessionRequest $request): JsonResponse
    {
        $this->deleteTherapySessionHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

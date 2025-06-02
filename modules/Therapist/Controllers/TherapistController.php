<?php

declare(strict_types=1);

namespace Modules\Therapist\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Modules\Therapist\Handlers\DeleteTherapistHandler;
use Modules\Therapist\Handlers\UpdateTherapistHandler;
use Modules\Therapist\Presenters\TherapistPresenter;
use Modules\Therapist\Requests\CreateTherapistRequest;
use Modules\Therapist\Requests\DeleteTherapistRequest;
use Modules\Therapist\Requests\GetTherapistListRequest;
use Modules\Therapist\Requests\GetTherapistRequest;
use Modules\Therapist\Requests\UpdateTherapistRequest;
use Modules\Therapist\Services\TherapistCRUDService;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\JsonResponse;

class TherapistController extends Controller
{
    public function __construct(
        private TherapistCRUDService $therapistService,
        private UpdateTherapistHandler $updateTherapistHandler,
        private DeleteTherapistHandler $deleteTherapistHandler,
    ) {
    }

    public function index(GetTherapistListRequest $request): JsonResponse
    {
        $list = $this->therapistService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(TherapistPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function store(CreateTherapistRequest $request):JsonResponse
    {
        $createdItem = $this->therapistService->create($request->createCreateTherapistDTO());

        $presenter = new TherapistPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function show(GetTherapistRequest $request): JsonResponse
    {
        $item = $this->therapistService->get(Uuid::fromString($request->route('id')));;

        $presenter = new TherapistPresenter($item);

        return Json::item($presenter->getData());
    }

    public function update(UpdateTherapistRequest $request): JsonResponse
    {
        $command = $request->createUpdateTherapistCommand();
        $this->updateTherapistHandler->handle($command);

        $item = $this->therapistService->get($command->getId());

        $presenter = new TherapistPresenter($item);

        return Json::item($presenter->getData());
    }

    public function delete(DeleteTherapistRequest $request): JsonResponse
    {
        $this->deleteTherapistHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

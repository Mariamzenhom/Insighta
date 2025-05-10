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

class TherapistController extends Controller
{
    public function __construct(
        private TherapistCRUDService $therapistService,
        private UpdateTherapistHandler $updateTherapistHandler,
        private DeleteTherapistHandler $deleteTherapistHandler,
    ) {
    }

    public function index(GetTherapistListRequest $request): View
    {
        $list = $this->therapistService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return view('therapist::index', [
            'items' => $list['data'],
        ]);
    }

    public function create(GetTherapistRequest $request): View
    {
        $user = $this->therapistService->getUser();

        return view('therapist::form',[
            'users'=> $user,
        ]);
    }

    public function store(CreateTherapistRequest $request)
    {
        $createdItem = $this->therapistService->create($request->createCreateTherapistDTO());

        $presenter = new TherapistPresenter($createdItem);

        return redirect()->route('therapist.index');
    }

    public function edit(GetTherapistRequest $request): View
    {
        $user = $this->therapistService->getUser();

        return view('therapist::form',[
            'users'=> $user,
            'therapist' => $this->therapistService->get(Uuid::fromString($request->route('id'))),
        ]);
    }

    public function update(UpdateTherapistRequest $request)
    {
        $command = $request->createUpdateTherapistCommand();
        $this->updateTherapistHandler->handle($command);

        $item = $this->therapistService->get($command->getId());

        $presenter = new TherapistPresenter($item);

        return redirect()->route('therapist.index');
    }

    public function delete(DeleteTherapistRequest $request): View
    {
        $this->deleteTherapistHandler->handle(Uuid::fromString($request->route('id')));

        return view::deleted();
    }
}

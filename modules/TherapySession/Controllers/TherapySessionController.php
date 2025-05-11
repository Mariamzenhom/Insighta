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

    public function index()
    {
        $sessions = $this->therapySessionService->list();

        return view('therapysession::index', [
            'sessions' => $sessions['data'],
        ]);
    }

    public function create()
    {
        return view('therapysession::form', [
            'users' => $this->therapySessionService->getUsers(),
            'therapists' => $this->therapySessionService->getTherapists(),
        ]);
    }

    public function store(CreateTherapySessionRequest $request)
    {
        $this->therapySessionService->create($request->createDTO());

        return redirect()->route('therapy.session.index')
                         ->with('success', 'Therapy session created successfully.');
    }
}

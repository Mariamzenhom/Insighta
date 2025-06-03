<?php

declare(strict_types=1);

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Handlers\DeleteUserHandler;
use Modules\User\Handlers\UpdateUserHandler;
use Modules\User\Requests\CreateUserRequest;
use Modules\User\Requests\DeleteUserRequest;
use Modules\User\Requests\UpdateUserRequest;
use Modules\User\Services\UserCRUDService;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function __construct(
        private UserCRUDService $userService,
        private UpdateUserHandler $updateUserHandler,
        private DeleteUserHandler $deleteUserHandler,

        ) {}
    public function index(Request $request)
    {
        $result = $this->userService->list(
            (int) $request->get('page', 1),
            10
        );

        return view('users::index', [
            'users' => $result['data'], // this is a simple array
            'pagination' => $result['pagination']
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $this->userService->create($request->createCreateUserDTO());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(string $id)
    {
        $user = $this->userService->get($id);

        return view('users::edit', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $command = $request->createUpdateUserCommand();
        $this->updateUserHandler->handle($command);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(DeleteUserRequest $request)
    {
        $this->deleteUserHandler->handle($request->route('id'));

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}

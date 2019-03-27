<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\User\CreateUserRequest;
use App\Http\Requests\Management\User\UpdateUserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Utils\Messages\User\NotFoundMessage;
use App\Utils\Messages\User\SuccessCreateMessage;
use App\Utils\Messages\User\SuccessDeleteMessage;
use App\Utils\Messages\User\SuccessUpdateMessage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return view('management.user.list');
    }

    public function create()
    {
        $roles = $this->roleRepository->getAll();

        return view('management.user.create', [
            'roles' => $roles
        ]);
    }

    public function details($id)
    {
        $user = $this->userRepository->getById($id);

        return view('management.user.details', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $roles = $this->roleRepository->getAll();

        return view('management.user.edit', [
            'user' => json_encode($user),
            'roles' => $roles
        ]);
    }

    public function createUser(CreateUserRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role')
        ];

        $this->userService->create($data);

        SuccessCreateMessage::initFlashMessage();

        return redirect()->route('get.manage.user.show');
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = [
            'id' => $request->get('user_id'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role')
        ];

        if ($request->get('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }

        $this->userService->update($data);

        SuccessUpdateMessage::initFlashMessage();

        return redirect()->route('get.manage.user.show');
    }

    public function deleteUser(Request $request)
    {
        try {
            $this->userService->delete($request->get('id'));
        } catch (ModelNotFoundException $e) {
            NotFoundMessage::initFlashMessage();
            return redirect()->route('get.manage.user.show');
        }

        SuccessDeleteMessage::initFlashMessage();
        return redirect()->route('get.manage.user.show');
    }
}

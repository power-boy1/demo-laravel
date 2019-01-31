<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\CreateUserRequest;
use App\Http\Requests\Management\UpdateUserRequest;
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
    protected $userService;
    protected $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('management.user.list');
    }

    public function create()
    {
        return view('management.user.create');
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

        return view('management.user.edit', [
            'user' => json_encode($user)
        ]);
    }

    public function createUser(CreateUserRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ];

        $this->userService->registration($data);

        SuccessCreateMessage::initFlashMessage();

        return redirect()->route('get.manage.user.show');
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = [
            'id' => $request->get('user_id'),
            'name' => $request->get('name'),
            'email' => $request->get('email')
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

<?php

namespace App\Http\Controllers\Api\Management;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lists\PaginatorUserResource;
use App\Http\Resources\Messages\ErrorResource;
use App\Http\Resources\Messages\SuccessResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Utils\Messages\User\NotFoundMessage;
use App\Utils\Messages\User\SuccessDeleteMessage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function list(Request $request)
    {
        $categories = $this->userRepository->list($request);

        $categories = $categories->paginate(User::PAGINATE_PER_PAGE);

        return PaginatorUserResource::make($categories);
    }

    public function deleteUser($id)
    {
        try {
            $this->userService->delete($id);
        } catch (ModelNotFoundException $e) {
            return ErrorResource::make(['text' => NotFoundMessage::getText()]);
        }

        return SuccessResource::make(['text' => SuccessDeleteMessage::getText()]);
    }
}

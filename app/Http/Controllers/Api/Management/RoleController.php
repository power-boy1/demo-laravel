<?php

namespace App\Http\Controllers\Api\Management;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lists\Role\PaginatorRoleResource;
use App\Http\Resources\Messages\ErrorResource;
use App\Http\Resources\Messages\SuccessResource;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Services\RoleService;
use App\Utils\Messages\Role\HasUsersMessage;
use App\Utils\Messages\Role\NotFoundMessage;
use App\Utils\Messages\Role\SuccessDeleteMessage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $roleService;

    public function __construct(RoleRepository $roleRepository, RoleService $roleService)
    {
        $this->roleRepository = $roleRepository;
        $this->roleService = $roleService;
    }

    public function list(Request $request)
    {
        $roles = $this->roleRepository->list($request);

        $roles = $roles->paginate(Role::PAGINATE_PER_PAGE);

        return PaginatorRoleResource::make($roles);
    }

    public function deleteRole($id)
    {
        try {
            if ($this->roleService->hasUsers($id)) {
                return ErrorResource::make(['text' => HasUsersMessage::getText()]);
            }

            $this->roleService->delete($id);
        } catch (ModelNotFoundException $e) {
            return ErrorResource::make(['text' => NotFoundMessage::getText()]);
        }

        return SuccessResource::make(['text' => SuccessDeleteMessage::getText()]);
    }
}

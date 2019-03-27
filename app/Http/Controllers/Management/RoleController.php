<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Role\CreateRoleRequest;
use App\Http\Requests\Management\Role\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Services\RoleService;
use App\Utils\Messages\Role\HasUsersMessage;
use App\Utils\Messages\Role\NotFoundMessage;
use App\Utils\Messages\Role\SuccessCreateMessage;
use App\Utils\Messages\Role\SuccessDeleteMessage;
use App\Utils\Messages\Role\SuccessUpdateMessage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;
    protected $roleRepository;

    public function __construct(RoleService $roleService, RoleRepository $roleRepository)
    {
        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return view('management.role.list');
    }

    public function create()
    {
        return view('management.role.create');
    }

    public function details($id)
    {
        $role = $this->roleRepository->getById($id);

        return view('management.role.details', [
            'role' => $role
        ]);
    }

    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);

        return view('management.role.edit', [
            'role' => json_encode($role)
        ]);
    }

    public function createRole(CreateRoleRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        $this->roleService->create($data);

        SuccessCreateMessage::initFlashMessage();

        return redirect()->route('get.manage.role.show');
    }

    public function updateRole(UpdateRoleRequest $request)
    {
        $data = [
            'id' => $request->get('item_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ];

        $this->roleService->update($data);

        SuccessUpdateMessage::initFlashMessage();

        return redirect()->route('get.manage.role.show');
    }

    public function deleteRole(Request $request)
    {
        try {
            if ($this->roleService->hasUsers($request->get('id'))) {
                HasUsersMessage::initFlashMessage();
                return redirect()->route('get.manage.role.show');
            }

            $this->roleService->delete($request->get('id'));
        } catch (ModelNotFoundException $e) {
            NotFoundMessage::initFlashMessage();
            return redirect()->route('get.manage.role.show');
        }

        SuccessDeleteMessage::initFlashMessage();
        return redirect()->route('get.manage.role.show');
    }
}

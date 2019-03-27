<?php

use App\Http\Controllers\Management\RoleController;
use App\Repositories\RoleRepository;
use App\Services\RoleService;
use App\Models\Role;
use App\Http\Requests\Management\Role\CreateRoleRequest;
use App\Http\Requests\Management\Role\UpdateRoleRequest;
use App\Utils\Messages\Role\SuccessDeleteMessage;
use App\Utils\Messages\Role\NotFoundMessage;
use Illuminate\Http\Request;

class UnitManagementRoleCest
{
    /**
     * @var RoleController
     */
    private $roleController;

    public function _before(UnitTester $I)
    {
        $this->roleController = new RoleController(
            new RoleService(),
            new RoleRepository()
        );
    }

    public function create(UnitTester $I)
    {
        $request = CreateRoleRequest::create(
            route('post.manage.role.create'),
            'post',
            [
                'name' => 'New role'
            ]
        );

        $this->roleController->createRole($request);

        $I->seeRecord('roles', ['name' => 'New role']);
    }

    public function update(UnitTester $I)
    {
        $role = factory(Role::class)->create();

        $request = UpdateRoleRequest::create(
            route('post.manage.role.update'),
            'post',
            [
                'item_id' => $role->id,
                'name' => 'Edited',
            ]
        );

        $this->roleController->updateRole($request);

        $I->seeRecord('roles', ['id' => $role->id, 'name' => 'Edited']);
    }

    public function delete(UnitTester $I)
    {
        $role = factory(Role::class)->create();

        $request = Request::create(
            route('post.manage.role.delete'),
            'post',
            ['id' => $role->id]
        );

        $this->roleController->deleteRole($request);

        $I->seeInSession('flashMessage', [
            'type' => 'success',
            'title' => '',
            'text' => SuccessDeleteMessage::getText()
        ]);

        $I->dontSeeRecord('roles', ['id' => $role->id]);
    }

    public function deleteFail(UnitTester $I)
    {
        $request = Request::create(
            route('post.manage.role.delete'),
            'post',
            ['id' => 0]
        );

        $this->roleController->deleteRole($request);

        $I->seeInSession('flashMessage', [
            'type' => 'error',
            'title' => '',
            'text' => NotFoundMessage::getText()
        ]);
    }
}

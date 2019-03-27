<?php

use App\Http\Controllers\Management\UserController;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Requests\Management\User\CreateUserRequest;
use App\Http\Requests\Management\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\Messages\User\SuccessDeleteMessage;
use App\Utils\Messages\User\NotFoundMessage;

/**
 * Class UnitManagementUserCest
 *
 * @property UserController $userController
 */
class UnitManagementUserCest
{
    protected $userController;

    public function _before(UnitTester $I)
    {
        $this->userController = new UserController(
            new UserService(),
            new UserRepository(),
            new RoleRepository()
        );
    }

    public function create(UnitTester $I)
    {
        $request = CreateUserRequest::create(
            route('post.manage.user.create'),
            'post',
            [
                'name' => 'New user',
                'email' => 'NewUser@mail.com',
                'password' => 'password',
                'role' => 3
            ]
        );

        $this->userController->createUser($request);

        $I->seeRecord('users', ['email' => 'NewUser@mail.com']);
    }

    public function update(UnitTester $I)
    {
        $user = factory(User::class)->create();

        $request = UpdateUserRequest::create(
            route('post.manage.user.update'),
            'post',
            [
                'user_id' => $user->id,
                'name' => 'Edited',
                'email' => 'NewUser@mail.com',
                'role' => $user->role_id
            ]
        );

        $this->userController->updateUser($request);

        $I->seeRecord('users', ['id' => $user->id, 'name' => 'Edited', 'password' => $user->password]);
    }

    public function delete(UnitTester $I)
    {
        $user = factory(User::class)->create();

        $request = Request::create(
            route('post.manage.user.delete'),
            'post',
            ['id' => $user->id]
        );

        $this->userController->deleteUser($request);

        $I->seeInSession('flashMessage', [
            'type' => 'success',
            'title' => '',
            'text' => SuccessDeleteMessage::getText()
        ]);

        $I->dontSeeRecord('roles', ['id' => $user->id]);
    }

    public function deleteFail(UnitTester $I)
    {
        $request = Request::create(
            route('post.manage.user.delete'),
            'post',
            ['id' => 1]
        );

        $this->userController->deleteUser($request);

        $I->seeInSession('flashMessage', [
            'type' => 'error',
            'title' => '',
            'text' => NotFoundMessage::getText()
        ]);
    }
}

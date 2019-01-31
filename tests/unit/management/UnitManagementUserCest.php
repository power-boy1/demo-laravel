<?php

use App\Http\Controllers\Management\UserController;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Http\Requests\Management\CreateUserRequest;
use App\Http\Requests\Management\UpdateUserRequest;
use App\Models\User;

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
        $this->userController = new UserController(new UserService(), new UserRepository());
    }

    public function create(UnitTester $I)
    {
        $request = CreateUserRequest::create(
            route('post.manage.user.create'),
            'post',
            [
                'name' => 'New user',
                'email' => 'NewUser@mail.com',
                'password' => 'password'
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
                'email' => 'NewUser@mail.com'
            ]
        );

        $this->userController->updateUser($request);

        $I->seeRecord('users', ['id' => $user->id, 'name' => 'Edited', 'password' => $user->password]);
    }
}

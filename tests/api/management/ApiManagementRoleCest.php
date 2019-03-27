<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Utils\Messages\Role\SuccessDeleteMessage;
use App\Utils\Messages\Role\NotFoundMessage;
use App\Utils\Messages\Role\HasUsersMessage;

class ApiManagementRoleCest
{
    public function _before(ApiTester $I)
    {
        $role = Role::where('name', Role::SUPER_ADMIN)->first();
        $user = factory(User::class)->create(['role_id' => $role->id]);

        Auth::loginUsingId($user->id);
    }

    public function _after(ApiTester $I)
    {
        Auth::logout();
    }

    public function list(ApiTester $I)
    {
        $users = factory(Role::class, 28)->create();

        $I->sendGET(route('get.manage.role.list'));

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson(
            ['id' => $users[0]->id],
            ['id' => $users[26]->id]
        );

        $I->cantSeeResponseContainsJson(['data' => [
            ['id' => $users[27]->id]
        ]]);
    }

    public function deleteSuccess(ApiTester $I)
    {
        $role = factory(Role::class)->create();

        $I->sendDELETE(route('delete.manage.role.delete', ['id' => $role->id]));

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['data' => ['text' => SuccessDeleteMessage::getText()]]);

        $I->dontSeeRecord('roles', ['id' => $role->id]);
    }

    public function deleteFail(ApiTester $I)
    {
        $I->sendDELETE(route('delete.manage.role.delete', ['id' => 0]));
        $I->seeResponseContainsJson(['data' => ['text' => NotFoundMessage::getText()]]);
    }

    public function deleteFailHasUsers(ApiTester $I)
    {
        factory(User::class)->create();

        $I->sendDELETE(route('delete.manage.role.delete', ['id' => 3]));
        $I->seeResponseContainsJson(['data' => ['text' => HasUsersMessage::getText()]]);
    }
}

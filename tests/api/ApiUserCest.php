<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Utils\Messages\User\SuccessDeleteMessage;
use App\Utils\Messages\User\NotFoundMessage;

class ApiUserCest
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

    public function deleteSuccess(ApiTester $I)
    {
        $user = factory(User::class)->create();

        $I->sendDELETE(route('delete.manage.user.delete', ['id' => $user->id]));

        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(['data' => ['text' => SuccessDeleteMessage::getText()]]);

        $I->dontSeeRecord('users', ['id' => $user->id]);
    }

    public function deleteFail(ApiTester $I)
    {
        $I->sendDELETE(route('delete.manage.user.delete', ['id' => 1]));
        $I->seeResponseContainsJson(['data' => ['text' => NotFoundMessage::getText()]]);
    }
}

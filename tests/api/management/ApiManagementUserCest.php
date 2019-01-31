<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiManagementUserCest
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

    public function categoryList(ApiTester $I)
    {
        $users = factory(User::class, 32)->create();

        $I->sendGET(route('get.manage.user.list'));

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson(['data' => [
            ['id' => $users[0]->id],
            ['id' => $users[29]->id]
        ]]);

        $I->cantSeeResponseContainsJson(['data' => [
            ['id' => $users[30]->id]
        ]]);
    }
}

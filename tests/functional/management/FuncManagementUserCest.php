<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FuncManagementUserCest
{
    public function _before(FunctionalTester $I)
    {
        $role = Role::where('name', Role::SUPER_ADMIN)->first();
        $user = factory(User::class)->create(['role_id' => $role->id]);

        Auth::loginUsingId($user->id);
    }

    public function _after(FunctionalTester $I)
    {
        Auth::logout();
    }

    public function userListPage(FunctionalTester $I)
    {
        $I->amOnPage(route('get.manage.user.show'));
        $I->see('Users list');
    }

    public function detailsPage(FunctionalTester $I)
    {
        $user = factory(User::class)->create();

        $I->amOnPage(route('get.manage.user.details', ['id' => $user->id]));
        $I->see('User details');
    }

    public function createUserPage(FunctionalTester $I)
    {
        $I->amOnPage(route('get.manage.user.create'));
        $I->see('Create user');
    }

    public function editUserPage(FunctionalTester $I)
    {
        $user = factory(User::class)->create();

        $I->amOnPage(route('get.manage.user.edit', ['id' => $user->id]));
        $I->see('Edit user');
    }

    public function editUserPageFail(FunctionalTester $I)
    {
        $I->amOnPage(route('get.manage.user.edit', ['id' => 1]));
        $I->seePageNotFound();
    }
}

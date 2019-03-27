<?php

use App\Models\Role;
use App\Models\User;

class FuncManagementRoleCest
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

    public function listPage(FunctionalTester $I)
    {
        $I->amOnPage(route('get.manage.role.show'));
        $I->see('Roles list');
    }

    public function listPageFail(FunctionalTester $I)
    {
        Auth::logout();

        $I->amOnPage(route('get.manage.role.show'));
        $I->seeResponseCodeIs(403);
    }

    public function detailsPage(FunctionalTester $I)
    {
        $role = factory(Role::class)->create();

        $I->amOnPage(route('get.manage.role.details', ['id' => $role->id]));
        $I->see('Role details');
    }

    public function createPage(FunctionalTester $I)
    {
        $I->amOnPage(route('get.manage.role.create'));
        $I->see('Create role');
    }

    public function editPage(FunctionalTester $I)
    {
        $role = factory(Role::class)->create();

        $I->amOnPage(route('get.manage.role.edit', ['id' => $role->id]));
        $I->see('Edit role');
    }

    public function editPageFail(FunctionalTester $I)
    {
        $I->amOnPage(route('get.manage.role.edit', ['id' => 0]));
        $I->seePageNotFound();
    }
}

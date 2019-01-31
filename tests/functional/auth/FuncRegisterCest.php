<?php

use App\Models\User;
use App\Models\Auth\UserAction;

class FuncRegisterCest
{
    public function registerSuccess(FunctionalTester $I)
    {
        $I->amOnRoute('get.auth.register');

        $I->submitForm('form#register', [
            'name' => 'Test',
            'email' => 'Test@test.com',
            'password' => 'Test123',
            'password_confirmation' => 'Test123'
        ]);

        $I->seeRecord('users', ['email' => 'Test@test.com']);
        $I->seeRecord('user_actions', ['action' => UserAction::ACTIVATE_ACCOUNT]);

        $I->see('Success registration. Now, check your email please.');
    }

    public function registerFail(FunctionalTester $I)
    {
        $user = factory(User::class)->create();

        $I->amOnRoute('get.auth.register');

        $I->submitForm('form#register', [
            'name' => 'Test',
            'email' => $user->email,
            'password' => 'Test123',
            'password_confirmation' => 'Test123'
        ]);

        $I->see('The email has already been taken.');
    }

    public function confirmAccountSuccess(FunctionalTester $I)
    {
        $user = factory(User::class)->create();
        $userAction = factory(UserAction::class)->create(['user_id' => $user->id]);

        $I->amOnRoute('get.auth.accountVerify', ['token' => $userAction->token]);

        $I->see('Success confirm account.');
    }

    public function confirmAccountFail(FunctionalTester $I)
    {
        $I->amOnRoute('get.auth.accountVerify', ['token' => 'Wrong token']);

        $I->seePageNotFound();
    }
}

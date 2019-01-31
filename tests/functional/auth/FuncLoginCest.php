<?php

use App\Models\User;

/**
 * Class FuncLoginCest
 *
 * @property User $user
 */
class FuncLoginCest
{
    protected $user;

    public function _before(FunctionalTester $I)
    {
        $this->user = factory(User::class)->create();
    }

    public function loginSuccess(FunctionalTester $I)
    {
        $I->amOnRoute('get.auth.login');

        $I->submitForm('form#login', ['email' => $this->user->email, 'password' => 'secret']);

        $I->see('Welcome ' . $this->user->name);
    }

    public function loginFail(FunctionalTester $I)
    {
        $I->amOnRoute('get.auth.login');

        $I->submitForm('form#login', ['email' => $this->user->email, 'password' => 'wrong password']);

        $I->dontSee('Welcome ' . $this->user->name);
    }
}

<?php

use App\Models\User;
use App\Models\Auth\UserAction;

/**
 * Class FuncPasswordResetCest
 *
 * @property User $user
 */
class FuncPasswordResetCest
{
    protected $user;

    public function _before(FunctionalTester $I)
    {
        $this->user = factory(User::class)->create();
    }

    public function resetPassCreateActionSuccess(FunctionalTester $I)
    {
        $I->amOnRoute('get.auth.resetPassword');

        $I->submitForm('form#resetPassword', ['email' => $this->user->email]);

        $I->seeRecord('user_actions', ['user_id' => $this->user->id, 'action' => UserAction::RECOVER_PASSWORD]);

        $I->see('Action for reset pass successful created. Now, check your email please.');
    }

    public function resetPassCreateActionFail(FunctionalTester $I)
    {
        $I->amOnRoute('get.auth.resetPassword');

        $I->submitForm('form#resetPassword', ['email' => $this->user->email . 'fail']);

        $I->dontSeeRecord('user_actions', ['user_id' => $this->user->id, 'action' => UserAction::RECOVER_PASSWORD]);

        $I->see('Email not found');
    }

    public function changePassSuccess(FunctionalTester $I)
    {
        $userAction = factory(UserAction::class)->create([
            'user_id' => $this->user->id,
            'action' => UserAction::RECOVER_PASSWORD
        ]);

        $I->amOnRoute('get.auth.changePassword', ['token' => $userAction->token]);

        $I->submitForm('form#changePassword', [
            'token' => $userAction->token,
            'password' => 'Test123',
            'password_confirmation' => 'Test123'
        ]);

        $I->dontSeeRecord('users', ['id' => $this->user->id,'password' => $this->user->password]);

        $I->see('Password successful changed');
    }

    public function changePassFail(FunctionalTester $I)
    {
        $userAction = factory(UserAction::class)->create([
            'user_id' => $this->user->id,
            'action' => UserAction::RECOVER_PASSWORD
        ]);

        $I->amOnRoute('get.auth.changePassword', ['token' => $userAction->token]);

        $I->submitForm('form#changePassword', [
            'token' => $userAction->token,
            'password' => 'Test123',
            'password_confirmation' => 'test321'
        ]);

        $I->seeRecord('users', ['id' => $this->user->id,'password' => $this->user->password]);

        $I->see('PASSWORDS DON\'T MATCH!');
    }
}

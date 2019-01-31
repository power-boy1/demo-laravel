<?php

namespace App\Services;

use App\Models\Auth\UserAction;
use App\Models\User;

class UserActionService
{
    /**
     * Create new action for user
     *
     * @param User $user
     * @param string $token
     * @param string $action
     *
     * @return UserAction
     */
    public function create(User $user, string $token, string $action)
    {
        $userAction = UserAction::make(['token' => $token, 'action' => $action]);

        return tap($userAction, function (UserAction $userAction) use ($user) {
            $userAction->user()->associate($user);

            $userAction->save();
        });
    }
}

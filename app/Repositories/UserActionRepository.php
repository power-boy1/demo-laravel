<?php

namespace App\Repositories;

use App\Models\Auth\UserAction;

class UserActionRepository
{
    /**
     * Get user action by token
     *
     * @param string $token
     * @return UserAction
     */
    public function getByToken(string $token): ?UserAction
    {
        return UserAction::where('token', '=', $token)->first();
    }

    /**
     * Get action "Activate account" for user
     *
     * @param int $userId
     * @return UserAction
     */
    public function getActivateAccountAction(int $userId): ?UserAction
    {
        return UserAction::where('user_id', '=', $userId)
            ->where('action', '=', UserAction::ACTIVATE_ACCOUNT)
            ->first();
    }
}

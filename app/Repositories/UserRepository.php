<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserRepository
{
    /**
     * Get user by ID
     *
     * @param $userId
     * @return User|null
     */
    public function getById($userId): ?User
    {
        return User::findOrFail($userId);
    }

    /**
     * Get user by email
     *
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User
    {
        return User::where('email', '=', $email)->first();
    }

    /**
     * Get all exists actions for user
     *
     * @param User $user
     * @return Collection
     */
    public function getUserActions(User $user): Collection
    {
        return $user->userActions()->get();
    }

    public function list(Request $request)
    {
        $role = Role::where('name', Role::SUPER_ADMIN)->first(['id']);

        $sort = $request->get('desc') ?: 'asc';
        $key = $request->get('orderBy') ?: 'id';

        return User::orderBy($key, $sort)->where('role_id', '!=', $role->id);
    }
}

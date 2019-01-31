<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create new user
     *
     * @param array $data
     * @return User
     */
    public function registration(array $data): User
    {
        $user = User::make($data);

        $role = Role::where('name', '=', Role::USER)->first();

        return tap($user, function (User $user) use ($role) {
            $user->role()->associate($role);

            $user->save();
        });
    }

    /**
     * Update user
     *
     * @param array $data
     * @return User
     */
    public function update(array $data): User
    {
        $user = User::findOrFail($data['id']);

        $user->fill($data);

        return tap($user, function (User $user) {
            $user->save();
        });
    }

    /**
     * Delete user by ID
     *
     * @param $id
     * @throws ModelNotFoundException
     * @throws \Exception
     */
    public function delete($id): void
    {
        User::findOrFail($id)->delete();
    }

    /**
     * Change user password by ID
     *
     * @param $userId
     * @param string $password
     *
     * @return User
     */
    public function changePassword($userId, string $password): User
    {
        $user = User::find($userId);

        return tap($user, function (User $user) use ($password) {
            $user->password = Hash::make($password);
            $user->save();
        });
    }
}

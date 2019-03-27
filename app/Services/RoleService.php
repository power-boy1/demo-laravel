<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleService
{
    /**
     * Check user is admin or not
     *
     * @param $roleId
     * @return bool
     */
    public function isAdmin($roleId): bool
    {
        $role = Role::select('name')
            ->where('id', $roleId)
            ->first();

        if ($role === null) {
            return false;
        }

        return $role->name === 'admin';
    }

    /**
     * Check user is super admin or not
     *
     * @param $roleId
     * @return bool
     */
    public function isSuperAdmin($roleId): bool
    {
        $role = Role::select('name')
            ->where('id', $roleId)
            ->first();

        if ($role === null) {
            return false;
        }

        return $role->name === 'superAdmin';
    }

    /**
     * Check, role has users or not
     *
     * @param $roleId
     * @return bool
     */
    public function hasUsers($roleId): bool
    {
        $users = Role::findOrFail($roleId)->users()->get();

        return $users->count() > 0;
    }

    /**
     * Create new role
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data): Role
    {
        $role = Role::make($data);

        return tap($role, function (Role $role) {
            $role->save();
        });
    }

    /**
     * Update role
     *
     * @param array $data
     * @return Role
     */
    public function update(array $data): Role
    {
        $role = Role::findOrFail($data['id']);

        $role->fill($data);

        return tap($role, function (Role $role) {
            $role->save();
        });
    }

    /**
     * Delete role by ID
     *
     * @param $id
     * @throws ModelNotFoundException
     * @throws \Exception
     */
    public function delete($id): void
    {
        Role::findOrFail($id)->delete();
    }
}

<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{

    /**
     * Check user is admin or not
     *
     * @param $roleId
     * @return bool
     */
    public function isAdmin($roleId)
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
    public function isSuperAdmin($roleId)
    {
        $role = Role::select('name')
            ->where('id', $roleId)
            ->first();

        if ($role === null) {
            return false;
        }

        return $role->name === 'superAdmin';
    }
}

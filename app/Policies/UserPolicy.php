<?php

namespace App\Policies;

use App\Models\User;
use App\Services\RoleService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    protected $roleService;

    /**
     * Create a new policy instance.
     *
     * @param RoleService $roleService
     * @return void
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Check ability to show admin panel
     *
     * @param User $user
     * @return bool
     */
    public function admin(User $user = null)
    {
        if (is_null($user)) {
            return false;
        }
        
        return $this->roleService->isAdmin($user->role_id);
    }

    /**
     * Check super admin status
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($this->roleService->isSuperAdmin($user->role_id)) {
            return true;
        }
    }
}

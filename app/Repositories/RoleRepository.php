<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleRepository
{
    /**
     * Get role by ID
     *
     * @param $id
     * @return Role
     */
    public function getById($id): Role
    {
        return Role::findOrFail($id);
    }

    /**
     * Get all
     *
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Role::all();
    }

    /**
     * Get roles list
     *
     * @param Request $request
     * @return Role
     */
    public function list(Request $request)
    {
        $sort = $request->get('desc') ?: 'asc';
        $key = $request->get('orderBy') ?: 'id';

        return Role::orderBy($key, $sort);
    }
}

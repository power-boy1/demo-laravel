<?php

namespace App\Models;

use Illuminate\Support\Carbon;

/**
 * Class Role
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Role extends \Eloquent
{
    const USER = 'user';
    const ADMIN = 'admin';
    const SUPER_ADMIN = 'superAdmin';

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

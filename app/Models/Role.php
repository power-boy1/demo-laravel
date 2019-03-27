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
    const PAGINATE_PER_PAGE = 30;

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

    public function getCreatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d/Y h:i:s A') : $date;
    }

    public function getUpdatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d/Y h:i:s A') : $date;
    }
}

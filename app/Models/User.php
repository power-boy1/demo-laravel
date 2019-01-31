<?php

namespace App\Models;

use App\Models\Auth\UserAction;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property Carbon email_verify_at
 * @property string $password
 * @property string $remember_token
 * @property integer $role_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class User extends \Eloquent implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    const PAGINATE_PER_PAGE = 30;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userActions()
    {
        return $this->hasMany(UserAction::class);
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

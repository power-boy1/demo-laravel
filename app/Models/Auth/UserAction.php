<?php

namespace App\Models\Auth;

use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * Class UserAction
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $action
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models\Auth
 */
class UserAction extends \Eloquent
{
    const ACTIVATE_ACCOUNT = 'activate_account';
    const RECOVER_PASSWORD = 'recover_password';

    protected $table = 'user_actions';

    protected $fillable = [
        'token',
        'action'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

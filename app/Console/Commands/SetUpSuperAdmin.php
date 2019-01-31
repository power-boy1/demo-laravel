<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class SetUpSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup super admin in system';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!User::where('email', '=', 'SuperAdmin@mail.com')->first()) {
            $role = Role::where('name', '=', Role::SUPER_ADMIN)->first();
            if ($role) {
                $user = User::make([
                    'name' => 'Super Admin',
                    'email' => 'SuperAdmin@mail.com',
                    'password' => \Hash::make('admin')
                ]);

                $user->role()->associate($role);
                $user->save();

                if (!$user) {
                    echo 'Error: can`t create new user!' . PHP_EOL;
                }
            } else {
                echo 'Error: role '. Role::SUPER_ADMIN . ' not found!' . PHP_EOL;
            }
        } else {
            echo 'Info: super admin already exist!' . PHP_EOL;
        }

        echo 'Success: super admin successful created!' . PHP_EOL;
    }
}

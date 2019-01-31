<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'superAdmin',
                'description' => null
            ],
            [
                'name' => 'admin',
                'description' => null
            ],
            [
                'name' => 'user',
                'description' => null
            ],
        ];

        foreach ($roles as $role) {
            if (!Role::where('name', '=', $role['name'])->first()) {
                Role::create([
                    'name' => $role['name'],
                    'description' => $role['description']
                ]);

                $this->command->info('Role ' . $role['name'] . ' successful created');
            }
        }

        $this->command->info('Roles successful created');
    }
}

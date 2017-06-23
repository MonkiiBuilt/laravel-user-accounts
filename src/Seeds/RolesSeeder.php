<?php

namespace MonkiiBuilt\LaravelUserAccounts\Seeds;

use Illuminate\Database\Seeder;
use MonkiiBuilt\LaravelUserAccounts\Models\Permission;
use MonkiiBuilt\LaravelUserAccounts\Models\Role;

class RolesSeeder extends Seeder
{

    public function run()
    {

        $roles = [
            'administrator' => [
                'display_name' => 'Administrator',
                'description' => 'The site admin role',
                'permissions' => ['manage_roles'],
            ],
            'member' => [
                'display_name' => 'Member',
                'description' => 'The default role, member.',
            ],
        ];

        foreach($roles as $role_name => $details) {

            $role = Role::create([
                'name' => $role_name,
                'display_name' => $details['display_name'],
                'description' => $details['description'],
            ]);

            if(!empty($details['permissions'])) {
                foreach($details['permissions'] as $permission) {
                    $permission = Permission::loadByName($permission);
                    $role->permissions()->attach($permission->id);
                }
            }

        }

    }

}
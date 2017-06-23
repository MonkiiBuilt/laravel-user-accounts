<?php

namespace MonkiiBuilt\LaravelUserAccounts\Seeds;

use Illuminate\Database\Seeder;
use MonkiiBuilt\LaravelUserAccounts\Models\Permission;

class PermissionsSeeder extends Seeder
{

    public function run()
    {
        $permissions = [
            'manage_roles' => [
                'display_name' => 'Manage roles',
                'description' => 'Add and remove roles from users.',
            ],
//            'access_admin_pages' => [
//                'display_name' => 'Access admin pages',
//                'description' => 'User can access admin pages',
//            ],
        ];

        foreach($permissions as $permission_name => $details) {
            Permission::create([
                'name' => $permission_name,
                'display_name' => $details['display_name'],
                'description' => $details['description'],
            ]);
        }

    }

}
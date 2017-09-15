<?php

namespace MonkiiBuilt\LaravelUserAccounts\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PermissionsSeeder::class);
         $this->call(RolesSeeder::class);
    }
}

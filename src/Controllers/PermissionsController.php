<?php

namespace MonkiiBuilt\LaravelUserAccounts\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use MonkiiBuilt\LaravelUserAccounts\Models\Role;
use MonkiiBuilt\LaravelUserAccounts\Models\Permission;

class PermissionsController extends \App\Http\Controllers\Controller
{
    private static $User;

    /**
     * Get a reference to wherever the user model is.
     *
     * UserAccountsController constructor.
     */
    public function __construct()
    {
        static::$User = Config::get('laravel-administrator.laravel-administrator-user-accounts.user_model');
    }

    /**
     * Build the permissions page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user-accounts::admin.permissions.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);

    }

    /**
     * Save the updates from the permissions page.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $roles = Role::all();
        foreach($roles as $role) {
            $role_data = $request->input($role->id);
            $role_permission_ids = $role_data ? array_keys($role_data) : [];
            $role->permissions()->sync($role_permission_ids);
        }
        return \Redirect::route('laravel-administrator-permissions');
    }
}

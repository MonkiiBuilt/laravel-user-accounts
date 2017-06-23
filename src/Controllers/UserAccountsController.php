<?php
/**
 * @author Jonathon Wallen <jonathon@monkii.com>
 * @date 24/4/17
 * @time 11:13 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUserAccounts\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use MonkiiBuilt\LaravelUserAccounts\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserAccountsController extends \App\Http\Controllers\Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = static::$User::all();
        return view('user-accounts::admin.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'display_name')->orderBy('id', 'desc')->pluck('display_name', 'id')->toArray();
        return view('user-accounts::admin.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        $validator = $this->validator($data);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $data['password'] = Hash::make($request->input('password'));

        if (!empty($data)) {

            $account = new static::$User($data);

            if ($account->save()) {

                // Assign the roles
                $account->roles()->sync($data['roles']);

                return \Redirect::route('laravel-administrator-user-accounts');
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = static::$User::findOrFail($id);
        $roles = Role::select('id', 'display_name')->orderBy('id', 'desc')->pluck('display_name', 'id')->toArray();
        $userRoles = $account->roles->toArray();
        $userRoleIds = array();
        foreach ($userRoles as $role) {
            $userRoleIds[] = $role['id'];
        }

        return view('user-accounts::admin.edit', [
            'account' => $account,
            'roles' => $roles,
            'userRoleIds' => $userRoleIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $account = static::$User::findOrFail($id);

        $data = $request->input();

        $account->update($data);

        $account->save;

        return \Redirect::route('laravel-administrator-user-accounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = static::$User::findOrFail($id);

        $account->delete();

        return \Redirect::route('laravel-administrator-user-accounts');
    }

    /**
     * Ajax endpoint for returning array of user accounts for datatables.
     *
     * @param Request $request
     * @param $year
     * @return mixed
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $accounts = static::$User::select(array('id', 'name', 'email', 'updated_at'));

            return Datatables::of($accounts)
                ->add_column(
                    'actions',
                    '<a title="Edit" href="{{{ URL::route(\'laravel-administrator-user-accounts-edit\', [\'id\' => $id]) }}}">Edit</a>' .
                    '{!! Form::open(array(\'route\' => [\'laravel-administrator-user-accounts-destroy\', $id], \'class\' => \'plain  confirm\')) !!}' .
                    '{!! Form::hidden(\'_method\', \'DELETE\') !!}' .
                    '<button type="submit">Delete</button>' .
                    '{!! Form::close() !!}'
                )
                ->remove_column('id')
                ->make();
        }

        abort(404, 'Page not found');
    }

    /**
     * Get a validator for account creation
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required|alpha|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
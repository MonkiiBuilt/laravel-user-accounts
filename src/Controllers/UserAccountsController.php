<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 11:13 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUserAccounts;


use App\User;
use Illuminate\Http\Request;

class UserAccountsController extends \App\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::all();

        return view('user-accounts::admin.index', ['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user-accounts::admin.create');
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

        $account = User::create($data);

        $account->save();

        return \Redirect::route('laravel-administrator-user-accounts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = User::findOrFail($id);

        return view('user-accounts::admin.create', ['account' => $account]);
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
        $account = User::findOrFail($id);

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
        $account = User::findOrFail($id);

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
    public function data(AccountsRequest $request, $year)
    {
        if ($request->ajax()) {
            $accounts = User::select(array('id', 'first_name', 'last_name', 'email', 'updated_at', \DB::raw("$year as 'year'")));

            return Datatables::of($accounts)
                ->add_column(
                    'actions',
                    '<a title="Edit" href="{{{ URL::route(\'laravel-administrator-user-accounts-edit\', [\'id\' => $id]) }}}">Edit</a>' .
                    '{!! Form::open(array(\'route\' => [\'laravel-administrator-user-accounts-delete\', $id], \'class\' => \'plain  confirm\')) !!}' .
                    '{!! Form::hidden(\'_method\', \'DELETE\') !!}' .
                    '<button type="submit">Delete</button>' .
                    '{!! Form::close() !!}'
                )
                ->remove_column('id')
                ->remove_column('year')
                ->make();
        }

        abort(404, 'Page not found');
    }
}
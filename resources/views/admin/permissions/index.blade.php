<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 11:45 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor/laravel-administrator.layout')

@section('title', 'Permissions')

@section('content')
    <h1>Permissions</h1>

    <div class="panel">

        {!! Form::open(array('route' => ['laravel-administrator-permissions-post'])) !!}

        <table id="accounts" class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width:20%">Permission</th>
                @foreach ($roles as $id => $role)
                    <th style="width:20%">{{ $role->display_name }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>

            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->display_name }}</td>
                    @foreach ($roles as $role)
                        <td>{{ Form::checkbox("{$role->id}[{$permission->id}]", $permission->name, !!$role->permissions->find($permission->id)) }}</td>
                    @endforeach
                </tr>
            @endforeach

            </tbody>
        </table>

        {!! Form::submit('Save') !!}
        {!! Form::close() !!}

    </div>

@endsection

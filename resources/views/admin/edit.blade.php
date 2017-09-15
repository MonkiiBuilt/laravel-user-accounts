<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 11:45 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor.laravel-administrator.layout')

@section('title', 'User Accounts')

@section('content')

    <h1>Edit user <em>{{ $account->name }}</em></h1>

    {!! Form::model($account, ['route' => ['laravel-administrator-user-accounts-put', 'id' => $account->id]]) !!}
    <div class="panel">
        <div class="panel__inner">

            @include('user-accounts::admin.form-fields')

        </div>
    </div>
    {!! Form::submit('Save') !!}
    {!! Form::close() !!}
@endsection

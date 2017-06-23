<?php
/**
 * @author Jonathon Wallen
 * @date 4/08/2016
 * @time 5:55 PM
 * @copyright (c) 2008-Present Monkii Digital Agency (http://monkii.com.au)
 */
?>

@extends('vendor/laravel-administrator.layout')

@section('title', 'Edit account')

@section('content')
    <h1>Edit account</h1>

    {!! Form::model($account, ['route' => ['laravel-administrator-user-accounts-put', $account->id], 'method' => 'PUT']) !!}

    <div class="panel">
        <div class="panel__inner">

            @include('user-accounts::admin.form-fields')

            @include('user-accounts::admin.permissions')

        </div>
    </div>

    {!! Form::submit('Save') !!}
    {!! Form::close() !!}
@endsection

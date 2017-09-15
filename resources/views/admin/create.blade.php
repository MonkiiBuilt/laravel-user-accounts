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

    <h1>Create a new user account</h1>

    {!! Form::open(array('route' => ['laravel-administrator-user-accounts-post'])) !!}
    <div class="panel">
        <div class="panel__inner">

            @include('user-accounts::admin.form-fields')

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Enter a password</h4>
                </div>
                <div class="panel__left">
                    <fieldset class="{{ $errors->has('password') ? 'error' : '' }}">
                        {!! Form::password('password') !!}
                        <div class="form__error">{{ $errors->first('password') }}</div>
                    </fieldset>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Confirm the password</h4>
                </div>
                <div class="panel__left">
                    <fieldset class="{{ $errors->has('password_confirmation') ? 'error' : '' }}">
                        {!! Form::password('password_confirmation') !!}
                        <div class="form__error">{{ $errors->first('password_confirmation') }}</div>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
    {!! Form::submit('Save') !!}
    {!! Form::close() !!}
@endsection


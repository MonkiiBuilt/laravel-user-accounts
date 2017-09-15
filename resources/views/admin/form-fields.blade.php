<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 4:46 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>


<div class="panel__row">
    <div class="panel__full">
        <h4>Email address</h4>
    </div>
    <div class="panel__left">
        <fieldset class="{{ $errors->has('email') ? 'error' : '' }}">
            {!! Form::email('email') !!}
            <div class="form__error">{{ $errors->first('email') }}</div>
        </fieldset>
    </div>
</div>

<div class="panel__row">
    <div class="panel__full">
        <h4>Name</h4>
    </div>
    <div class="panel__left">
        <fieldset class="{{ $errors->has('name') ? 'error' : '' }}">
            {!! Form::text('name') !!}
            <div class="form__error">{{ $errors->first('name') }}</div>
        </fieldset>
    </div>
</div>

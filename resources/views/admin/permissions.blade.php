@permission(['manage_roles'])
<div class="panel__row">
    <div class="panel__full">
        <h4>Status</h4>
    </div>
    <div class="panel__left">
        <fieldset class="{{ $errors->has('status') ? 'error' : '' }}">
            {!! Form::select('status', ['pending' => 'Pending', 'active' => 'Active', 'rejected' => 'Rejected'], null, array('class' => 'chosen-select')) !!}
            <div class="form__error">{{ $errors->first('status') }}</div>
        </fieldset>
    </div>
</div>

<div class="panel__row">
    <div class="panel__full">
        <h4>Roles</h4>
    </div>
    <div class="panel__left">
        @foreach ($roles as $id => $role)
            @if($role == 'Super User' && Auth::user() && !Auth::user()->can('permissions'))
                @continue
            @endif
            <fieldset class="{{ $errors->has('is_extended') ? 'error' : '' }}">
                <label class="form__label-check">
                    {!! Form::checkbox("roles[]", $id, null, array('class' => 'form-checkbox')) !!}
                    <span class="checkbox"></span>{{ $role }}
                </label>
                <div class="form__error">{{ $errors->first('is_extended') }}</div>
            </fieldset>
        @endforeach
    </div>
</div>
@endpermission

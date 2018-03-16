<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3">Name
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::text('name', $users->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Email
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::text('email', $users->email, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Area
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {{ Form::select('area_id[]', $area->pluck('name','id'), $area_id, ['class'=>'form-control select2-multiple','id'=>'multiple', 'multiple']) }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Group
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {{ Form::select('group_id', $group->pluck('name','id'), $users->detailuser->group_id, ['class'=>'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Password
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Password']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Confirm Password
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder' => 'Confirm Password']) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Active
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::select('active', ['0' => 'No', '1' => 'Yes'], $users->active, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <input id="submitButton" class="btn green" type="button" value="Submit" onclick="submitForm(this);" />
            <a href="{{ route('user.index') }}" class="btn grey-salsa btn-outline">Cancel</a>
        </div>
    </div>
</div>
<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3">Name
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Dealer ID
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::text('dealer_id', null, array('placeholder' => 'Dealer ID','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Address
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Area
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {{ Form::select('area_id', $area->pluck('name','id'), null, ['class'=>'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Grade
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::text('grade', null, array('placeholder' => 'Grade','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Active
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            {!! Form::select('active', ['0' => 'No', '1' => 'Yes'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <input id="submitButton" class="btn green" type="button" value="Submit" onclick="submitForm(this);" />
            <a href="{{ route('store.index') }}" class="btn grey-salsa btn-outline">Cancel</a>
        </div>
    </div>
</div>
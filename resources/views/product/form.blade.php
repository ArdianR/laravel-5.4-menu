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
        <label class="control-label col-md-3">Select
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
            <a href="{{ route('product.index') }}" class="btn grey-salsa btn-outline">Cancel</a>
        </div>
    </div>
</div>
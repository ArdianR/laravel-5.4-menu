@extends('layouts.menu')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-black"></i>
                            <span class="caption-subject font-black sbold uppercase">Create Store Product</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(array('route' => 'store.productStore','method'=>'POST', 'class' => 'form-horizontal')) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Dealer ID
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('store_id', $store->id, array('class' => 'form-control','readonly')) !!}
                                    {!! Form::text('dealer_id', $store->dealer_id, array('class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Store Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('name', $store->name, array('class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Address
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('address', $store->address, array('class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('area_id', $store->area->name, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Grade
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('grade', $store->grade, array('class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Active
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::select('active',  ['0' => 'No', '1' => 'Yes'], $store->active, ['class' => 'form-control', 'readonly'] ) !!}
                                </div>
                            </div>
                        </div>
                        <div id="dynamic_field">
                            <div class="form-group">
                                <label class="control-label col-md-3">POP Material List
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-3">
                                    {{ Form::select('product_id', $product->pluck('name','id'), null, ['class'=>'form-control','name' => 'product_id[]','required autofocus']) }}
                                </div>
                                <label class="control-label col-md-1">Qty
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-1">
                                    {!! Form::text('qty', null, array('class' => 'form-control','name'=>'qty[]','required autofocus')) !!}
                                </div>
                                <div class="col-md-1">
                                    <button type="button" name="add" id="add" class="form-control btn btn-icon-only green fa fa-plus"></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input id="submitButton" class="btn green" type="button" value="Submit" onclick="submitForm(this);" />
                                    <a href="{{ route('store.index') }}" class="btn default">Cancel</a>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- END FORM-->
                    </div>
                <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div>
    </div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" >
    $(document).ready(function(){
        var i=1;  
            $('#add').click(function(){  
                i++;  
                $('#dynamic_field').append('<div class="form-group" id="row'+i+'"><label class="control-label col-md-3"><span class="required">*</span></label><div class="col-md-3">{{ Form::select('product_id', $product->pluck('name','id'), null, ['class'=>'form-control','name' => 'product_id[]','required autofocus']) }}</div><label class="control-label col-md-1"><span class="required">*</span></label><div class="col-md-1">{!! Form::text('qty', null, array('class' => 'form-control','name'=>'qty[]','required autofocus')) !!}</div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');
            });  
            $(document).on('click', '.btn_remove', function(){
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
            });
        });  
</script>
@endsection
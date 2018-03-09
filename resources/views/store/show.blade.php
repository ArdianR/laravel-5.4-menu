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
                            <span class="caption-subject font-black sbold uppercase">SHOW store</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    {!! Form::model($store, ['method' => 'PATCH','route' => ['store.update', $store->id], 'class' => 'form-horizontal', 'id' => 'form_sample_1']) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Dealer ID
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('name', $store->dealer_id, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Store Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('name', $store->name, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Address
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('name', $store->address, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('name', $store->area_id, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Grade
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                        {!! Form::text('name', $store->grade, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
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
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
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
@endsection
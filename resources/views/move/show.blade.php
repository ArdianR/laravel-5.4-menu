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
                            <span class="caption-subject font-black sbold uppercase">SHOW AREA</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    {!! Form::model($area, ['method' => 'PATCH','route' => ['area.update', $area->id], 'class' => 'form-horizontal', 'id' => 'form_sample_1']) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                        {!! Form::text('name', $area->name, array('placeholder' => 'Name','class' => 'form-control','readonly')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alias
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('alias', null, array('placeholder' => 'Alias','class' => 'form-control','data-required' => '1', 'readonly')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Active
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::select('active',  ['0' => 'No', '1' => 'Yes'], $area->active, ['class' => 'form-control', 'readonly'] ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ route('area.index') }}" class="btn default">Cancel</a>
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
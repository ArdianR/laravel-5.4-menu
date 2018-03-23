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
                            <span class="caption-subject font-black sbold uppercase">Show Move</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    {!! Form::model($move, ['class' => 'form-horizontal']) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('area_id', $move->area->name,['class' => 'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">From
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('from_store_id', $move->fromstore->name,['class' => 'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Note
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::textarea('from_store_id', $move->note,['class' => 'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">To
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('to_store_id', $move->tostore->name,['class' => 'form-control','readonly']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{action('MoveController@list')}}" class="btn default">Cancel</a>
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
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
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Create Move New</span>
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
                    {!! Form::open(array('url' => 'move/store','method'=>'POST', 'class' => 'form-horizontal')) !!}
                    {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('area_id', $from->area->id, array('placeholder' => 'Area','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                                    {!! Form::text('area', $from->area->name, array('placeholder' => 'Area','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">From
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('from_store_id', $from->id, array('placeholder' => 'Store','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                                    {!! Form::text('store', $from->name, array('placeholder' => 'Store','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th class="all">No</th>
                                        <th class="all">Product Name</th>
                                        <th class="all">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store2 as $store3)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $store3->product->name }}</td>
                                        <td>{{ $store3->qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! Form::hidden('user_id', Auth::id(), array('placeholder' => 'User','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                            <div class="form-group">
                                <label class="control-label col-md-3">Note
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::textarea('note', null, array('placeholder' => 'Note','class' => 'form-control','required'=>'true')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">To
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::select('to_store_id', $store->pluck('name','id'), null, ['class'=>'form-control','required'=>'true']) }}
                                </div>
                            </div>
                            {!! Form::hidden('status_id', 5, array('placeholder' => 'status_id','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                            {!! Form::hidden('active', 1, array('placeholder' => 'active','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                        </div>
                        <div id="dynamic_field">
                            <div class="form-group">
                                <label class="control-label col-md-3">POP Material List
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::select('product_id[]', $product->pluck('name','id'), null, ['class'=>'form-control','id'=>'product','required'=>'true']) }}
                                </div>
                                <label class="control-label col-md-1">Qty
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-1">
                                    <input type="text" id="qty" name="qty[]" class="form-control" required autofocus>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" name="add" id="add" class="form-control btn btn-icon-only green fa fa-plus"></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green button-prevent-sbm"><i class="spinner fa fa-spinner fa-spin"></i> Submit</button>
                                    <a href="{{action('MoveController@index')}}" class="btn grey-salsa btn-outline">Cancel</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" >
    $(document).ready(function(){
        $('.spinner').hide();
        $('.form-prevent-sbm').on('submit',function(){
            $('.button-prevent-sbm').attr('disabled','true');
            $('.spinner').show();
        })
    });
</script>
<script type="text/javascript" >
    $(document).ready(function(){
        var i=1;  
            $('#add').click(function(){  
                i++;  
                $('#dynamic_field').append('<div class="form-group" id="row'+i+'"><label class="control-label col-md-3">POP Material List<span class="required">*</span></label><div class="col-md-4">{{ Form::select('product_id[]', $product->pluck('name','id'), null, ['class'=>'form-control','id'=>'product','required'=>'true']) }}</div><label class="control-label col-md-1">Qty<span class="required">*</span></label><div class="col-md-1"><input type="text" id="qty" name="qty[]" class="form-control" required="true" autofocus="true"></div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');
            });  
            $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
            });
        });  
</script>
@endsection
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
                    {!! Form::open(array('route' => 'area.store','method'=>'POST', 'class' => 'form-horizontal')) !!}
                    {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">From
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::select('from_store_id', $store->pluck('name','id'), $from->id, ['class'=>'form-control','readonly'=>'true','required'=>'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('area_id', $from->area_id, array('placeholder' => 'Area','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">User
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::text('user_id', Auth::id(), array('placeholder' => 'User','class' => 'form-control','required'=>'true','readonly'=>'true')) !!}
                                </div>
                            </div>
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
                                    {{ Form::select('from_store_id', $store->pluck('name','id'), null, ['class'=>'form-control','required'=>'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Status
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::select('status_id', $status->pluck('name','id'), 5, ['class'=>'form-control','readonly'=>'true','required'=>'true']) }}
                                </div>
                            </div>
                            @foreach($product as $product)
                            <div class="form-group">
                                <label class="control-label col-md-3">Product Store List
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-4">
                                    <select id="product" name="product_id[]" class="form-control" required autofocus>
                                        <option value="{{$product->product_id}}">{{$product->product->name}} = {{$product->qty}}</option>
                                    </select>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <input id="submitButton" class="btn green" type="button" value="Submit" onclick="submitForm(this);" />
                                    <a href="{{ route('area.index') }}" class="btn grey-salsa btn-outline">Cancel</a>
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
                $('#dynamic_field').append('<div class="form-group" id="row'+i+'"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-3"><select id="product" name="product_id[]" class="form-control" required autofocus>@foreach($product as $product)<option value="{{$product}}">{{$product}}</option>@endforeach</select></div><label class="control-label col-md-1">Qty<span class="required">*</span></label><div class="col-md-1"><input type="text" id="qty" name="qty[]" value="" class="form-control" required autofocus></div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');
            });  
            $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
            });
        });  
</script>
@endsection
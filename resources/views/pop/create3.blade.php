@extends('layouts.menu')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Note</span>
                        </div>
                        <div class="tools">
                            <a href="" class="expand" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: none;">
                        <div class="form-actions">
                           <li><b>Posisi utama</b> : Apakah Lightbox dan Showcase/Meja/Wall bay ada di posisi utama .<br>Posisi utama adalah posisi paling depan menghadap arah arus orang ,biasanya area dinding sebelah kanan dan kiri paling depan toko，atau dinding tengah hadapi pintu masuk.<br>Harus semua item di posisi utama baru bisa pilih <b>yes</b>
                           </li><br>
                           <li><b>Ukuran utama</b> : Apakah Lightbox dan Wall bay ukurannya paling besar dari Lightbox Brand lain di toko tersebut. Dan apakah showcase dan meja paling banyak dari Brand lain di toko tersebut.<br>Jika toko hanya ada Lightbox dan sudah paling besar bisa pilih <b>yes</b>. 
                            </li><br>
                            <li><b>POP Material List</b> : Kalian harus input material POP standar dan custom yang ada di toko tersebut.<br><br>
                                POP Standar_Showcase_Standar<br>
                                POP Standar_Showcase_Corner/Lightbox Corner<br>
                                POP Standar_Showcase_Dealer(3 Level)<br>
                                POP Standar_Showcase_Dealer Corner<br><br>

                                POP Standar_Meja_800<br>
                                POP Standar_Meja_1200<br>
                                POP Standar_Meja_1600<br>

                                POP Standar_Lightbox_1600<br>
                                POP Standar_Lightbox_2400<br>
                                POP Standar_Lightbox_3600<br>
                                POP Standar_Lightbox_4800<br>

                                POP Custom_Showcase<br>
                                POP Custom_Meja<br>
                                POP Custom_Lightbox<br>
                                POP Custom_Wall Bay<br><br>
                                Misal di dalam toko ada 1 Lightbox ukuran 2400 berarti pilih POP Standar_Lightbox_2400 , QTY 1 dan ada 2 showcase custom berarti pilih POP Custom_Showcase , QTY 2 <br>
                                <b>More Info : Arga & Boni</b>
                           </li>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Create Pop</span>
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
                    {!! Form::open(array('url' => 'pop/store3','method'=>'POST', 'class' => 'form-horizontal','enctype' => 'multipart/form-data','files' => 'true')) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            {!! Form::hidden('periode', 1, array('placeholder' => 'Periode','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                            {!! Form::hidden('user_id', Auth::id(), array('placeholder' => 'User ID','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('area_id', Auth::user()->detailuser->area->id, array('placeholder' => 'area_id','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                                    {!! Form::text('area', Auth::user()->detailuser->area->name, array('placeholder' => 'area_id','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                                </div>
                            </div>
                            {!! Form::hidden('group_id', Auth::user()->detailuser->group_id, array('placeholder' => 'group_id','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                            <div class="form-group">
                                <label class="control-label col-md-3">Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::select('store_id', $store->pluck('name','id'), $store_id, ['class'=>'form-control','readonly'=>'true','required'=>'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ilustrasi Pemasangan
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('type', 1, array('class' => 'form-control')) !!}
                                    <input type="file" name="photo[]" class="form-control" multiple="true" required="true" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Posisi
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::select('posisi', ['0' => 'No', '1' => 'Yes'], null, ['class' => 'form-control','required'=>'true']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ukuran
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::select('ukuran', ['0' => 'No', '1' => 'Yes'], null, ['class' => 'form-control','required'=>'true']) !!}
                                </div>
                            </div>
                            {!! Form::hidden('note', null, array('placeholder' => 'Note','class' => 'form-control','readonly'=>'true','required'=>'false')) !!}
                            {!! Form::hidden('status_id', 1, array('placeholder' => 'status_id','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                            {!! Form::hidden('active', 1, array('placeholder' => 'active','class' => 'form-control','readonly'=>'true','required'=>'true')) !!}
                        </div>
                        <div id="dynamic_field">
                            <div class="form-group">
                                <label class="control-label col-md-3">POP Material List
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-3">
                                    {{ Form::select('product_id[]', $product->pluck('name','id'), null, ['class'=>'form-control','id'=>'product','required'=>'true']) }}
                                </div>
                                <label class="control-label col-md-1">Qty
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-1">
                                    <input type="text" id="qty" name="qty[]" class="form-control" required="true" autofocus="true">
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
                                    <a href="{{action('PopController@index3')}}" class="btn grey-salsa btn-outline">Cancel</a>
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
                $('#dynamic_field').append('<div class="form-group" id="row'+i+'"><label class="control-label col-md-3"><span class="required"></span></label><div class="col-md-3">{{ Form::select('product_id[]', $product->pluck('name','id'), null, ['class'=>'form-control','id'=>'product']) }}</div><label class="control-label col-md-1">Qty<span class="required">*</span></label><div class="col-md-1"><input type="text" id="qty" name="qty[]" value="" class="form-control" required="true" autofocus="true"></div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>');
            });  
            $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
            });
        });  
</script>
@endsection
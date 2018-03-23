@extends('layouts.menu')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Show Move</span>
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
                    {!! Form::model($move, ['method' => 'PATCH','url' => ['pop/update33', $move->id], 'class' => 'form-horizontal','enctype' => 'multipart/form-data','files' => 'true']) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::text('area_id', $move->area->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">From Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::hidden('from_store_id', $move->from_store_id) }}
                                    {{ Form::text('from_store', $move->fromstore->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            @if ($move->status_id == 8)
                            <div class="form-group">
                                <label class="control-label col-md-3">To Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::select('to_store_id', $store->pluck('name','id'), null, ['class'=>'form-control','required'=>'true']) }}
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label class="control-label col-md-3">To Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::hidden('to_store_id', $move->to_store_id) }}
                                    {{ Form::text('to_store', $move->tostore->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label col-md-3">Note
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::textarea('note', $move->note, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            @if ($move->status_id == 9 || $move->status_id == 11)
                            <div class="form-group">
                                <label class="control-label col-md-3">Bukti Kirim
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('type', 1, array('class' => 'form-control')) !!}
                                    <input type="file" name="photo[]" class="form-control" multiple="true" required="true" />
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label class="control-label col-md-3">Bukti Kirim
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    @foreach ($photomove->where('type',1) as $photomove)
                                    <a data-fancybox class="thumbnail" href="{{ url(asset($photomove->photo)) }}">
                                        <img src="{{ url(asset($photomove->photo)) }}" class="img-responsiv" />
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if ($move->status_id == 12)
                            <div class="form-group">
                                <label class="control-label col-md-3">Bukti Terima
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('type', 2, array('class' => 'form-control')) !!}
                                    <input type="file" name="photo[]" class="form-control" multiple="true" required="true" />
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label class="control-label col-md-3">Bukti Terima
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    @foreach ($photomove->where('type',2) as $photomove)
                                    <a data-fancybox class="thumbnail" href="{{ url(asset($photomove->photo)) }}">
                                        <img src="{{ url(asset($photomove->photo)) }}" class="img-responsiv" />
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th class="all">No</th>
                                        <th class="desktop">Product Name</th>
                                        <th class="desktop">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailmove as $detailmove)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $detailmove->product->name }}</td>
                                        <td>{{ $detailmove->qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    @if ($move->status_id == 8)
                                    <button type="submit" name="status" value="8" class="btn green button-prevent-sbm"><i class="spinner fa fa-spinner fa-spin"></i> Submit</button>
                                    @elseif ($move->status_id == 9 || $move->status_id == 11)
                                    <button type="submit" name="status" value="9" class="btn green button-prevent-sbm"><i class="spinner fa fa-spinner fa-spin"></i> Submit</button>
                                    @elseif ($move->status_id == 12)
                                    <button type="submit" name="status" value="12" class="btn green button-prevent-sbm"><i class="spinner fa fa-spinner fa-spin"></i> Submit</button>
                                    @endif
                                    <a href="{{action('PopController@list33')}}" class="btn grey-salsa btn-outline">Cancel</a>
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
$(document).ready(function() {
    $(".fancybox").fancybox({
        openEffect  : 'none',
        closeEffect : 'none'
    });
});
</script>
<script type="text/javascript" >
    $(document).ready(function(){
        $('.spinner').hide();
        $('.form-prevent-sbm').on('submit',function(){
            $('.button-prevent-sbm').attr('disabled','true');
            $('.spinner').show();
        })
    });
</script>
@endsection
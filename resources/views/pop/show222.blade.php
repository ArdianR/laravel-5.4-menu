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
                            <span class="caption-subject font-dark sbold uppercase">Show Pop</span>
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
                    <form action="{{ URL('pop/approve/'. $move->id) }}" method="POST" class="form-horizontal">
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
                                <label class="control-label col-md-3">Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::hidden('from_store_id', $move->from_store_id) }}
                                    {{ Form::text('', $move->fromstore->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">To Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::hidden('to_store_id', $move->to_store_id) }}
                                    {{ Form::text('', $move->tostore->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Note
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::textarea('note', $move->note, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Bukti Kirim
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    @foreach ($photomove->where('type',1) as $photomove1)
                                    <a data-fancybox class="thumbnail" href="{{ url(asset($photomove1->photo)) }}">
                                        <img src="{{ url(asset($photomove1->photo)) }}" class="img-responsiv" />
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Bukti Terima
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    @foreach ($photomove->where('type',2) as $photomove2)
                                    <a data-fancybox class="thumbnail" href="{{ url(asset($photomove2->photo)) }}">
                                        <img src="{{ url(asset($photomove2->photo)) }}" class="img-responsiv" />
                                    </a>
                                    @endforeach
                                </div>
                            </div>
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
                                <div class="col-md-offset-2 col-md-9">
                                    @if ($move->status_id == 7)
                                    <button type="submit" name="approve_move" value="approve_move" class="btn btn-primary">Approve</button>
                                    <button type="submit" name="reject_move" value="reject_move" class="btn btn-danger">Reject</button>
                                    @elseif ($move->status_id == 10)
                                    <button type="submit" name="approve_upload" value="approve_upload" class="btn btn-primary">Approve</button>
                                    <button type="submit" name="reject_upload" value="reject_upload" class="btn btn-danger">Reject</button>
                                    @elseif ($move->status_id == 14)
                                    <button type="submit" name="approve_bukti" value="approve_bukti" class="btn btn-primary">Done</button>
                                    <button type="submit" name="reject_bukti" value="reject_bukti" class="btn btn-danger">Reject</button>
                                    @endif
                                    <a href="{{action('PopController@list22')}}" class="btn grey-salsa btn-outline">Cancel</a>
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
@endsection
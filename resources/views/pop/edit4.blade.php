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
                    {!! Form::model($pop, ['method' => 'PATCH','url' => ['pop/update4', $pop->id], 'class' => 'form-horizontal','enctype' => 'multipart/form-data','files' => 'true']) !!}
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Area
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::text('area_id', $pop->area->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Store
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {{ Form::hidden('store_id', $pop->store_id, ['class'=>'form-control','readonly']) }}
                                    {{ Form::text('store', $pop->store->name, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ilustrasi Pemasangan
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    @if ($pop->status_id == 2)
                                    {!! Form::hidden('type', 1, array('class' => 'form-control')) !!}
                                    <input type="file" name="photo[]" class="form-control" multiple="true" required="true" />
                                    @else
                                    @foreach ($pop->photopop->where('type',1) as $photopop)
                                    <a data-fancybox class="thumbnail" href="{{ url(asset($photopop->photo)) }}">
                                        <img src="{{ url(asset($photopop->photo)) }}" class="img-responsiv" />
                                    </a>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @if ($pop->status_id == 9)
                            <div class="form-group">
                                <label class="control-label col-md-3">Foto Pemasangan
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::hidden('type', 2, array('class' => 'form-control')) !!}
                                    @foreach ($pop->photopop->where('type',2) as $photopop2)
                                     {{ Form::hidden('photo2[]', $photopop2->photo, ['class'=>'form-control','readonly']) }}
                                    @endforeach
                                    <input type="file" name="photo[]" class="form-control" multiple="true" required="true" />
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label col-md-3">Posisi
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::select('posisi', ['0' => 'No', '1' => 'Yes'], $pop->posisi, ['class' => 'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ukuran
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    {!! Form::select('ukuran', ['0' => 'No', '1' => 'Yes'], $pop->ukuran, ['class' => 'form-control','readonly']) !!}
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
                                    @foreach ($detailpop as $detailpop)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $detailpop->product->name }}</td>
                                        <td>{{ $detailpop->qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="form-group">
                                <label class="control-label col-md-1">Note
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    {{ Form::textarea('note', $pop->note, ['class'=>'form-control','readonly']) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    @if ($pop->status_id == 2)
                                    <button type="submit" class="btn green button-prevent-sbm"><i class="spinner fa fa-spinner fa-spin"></i> Submit</button>
                                    <a href="{{action('PopController@list3')}}" class="btn grey-salsa btn-outline">Cancel</a>
                                    @elseif ($pop->status_id == 9)
                                    <button type="submit" class="btn green button-prevent-sbm"><i class="spinner fa fa-spinner fa-spin"></i> Submit</button>
                                    <a href="{{action('PopController@list3')}}" class="btn grey-salsa btn-outline">Cancel</a>
                                    @endif
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
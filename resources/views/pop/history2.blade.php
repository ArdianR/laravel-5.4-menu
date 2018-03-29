@extends('layouts.menu')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE HEADER-->
        <div class="portlet-title">
            <div class="caption">
                <span class="icon-settings font-dark caption-subject font-dark sbold uppercase page-title"> History </span>
            </div>
        </div>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <p><b>Regional : {{ $store->area->name }}</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Name Store : {{ $store->name }}</b>&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Uploaded : </b>{{ $pop->where('status_id',1)->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Rejected : </b>{{ $pop->where('status_id',2)->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Approved : </b>{{ $pop->where('status_id',3)->count() }}</p>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Total Product</span>
                        </div>
                        <div class="tools">
                            <a href="" class="expand" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: none;">
                        <table class="table table-striped table-bordered table-hover dt-responsive">
                            <th>Nama Produk</th>
                            <th>Total</th>
                            @foreach ($alls as $all)
                            <tr>                        
                                <td>{{ $all->name }}</td> 
                                <td><b>{{ $all->sum }}</b></td>                        
                            </tr> 
                            @endforeach                                         
                         </table>   
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Request Pop</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="font-red"></i>
                            <span class="caption-subject font-red sbold uppercase"></span>
                        </div>
                        <div class="tools">
                            <a href="" class="" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                            <thead>
                                <tr>
                                    <th class="all">No</th>
                                    <th class="desktop">Dealer ID</th>
                                    <th class="desktop">Name Store</th>
                                    <th class="none">Address</th>
                                    <th class="desktop">Area</th>
                                    <th class="desktop">Grade</th>
                                    <th class="desktop">Request</th>
                                    <th class="all">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pop as $pop)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $pop->store->dealer_id}}</td>
                                    <td>{{ $pop->store->name }}</td>
                                    <td>{{ $pop->store->address}}</td>
                                    <td>{{ $pop->store->area->name}}</td>
                                    <td>{{ $pop->store->grade}}</td>
                                    <td>{{ $pop->status->name }}</td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{action('PopController@history22', $pop->id)}}">
                                                        <i class="fa fa-eye"></i> Show
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Request Move</span>
                        </div>
                        <div class="tools">
                            <a href="" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="font-red"></i>
                            <span class="caption-subject font-red sbold uppercase"></span>
                        </div>
                        <div class="tools">
                            <a href="" class="" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_2">
                            <thead>
                                <tr>
                                    <th class="all">No</th>
                                    <th class="desktop">Area</th>
                                    <th class="desktop">From Store</th>
                                    <th class="desktop">To Store</th>
                                    <th class="desktop">Status</th>
                                    <th class="none">Note</th>
                                    <th class="none">Created Date</th>
                                    <th class="all">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($move as $move)
                                <tr>
                                    <td>{{ ++$ii }}</td>
                                    <td>{{ $move->area->name}}</td>
                                    <td>{{ $move->fromstore->name }}</td>
                                    <td>{{ $move->tostore->name}}</td>
                                    <td>{{ $move->status->name}}</td>
                                    <td>{{ $move->note}}</td>
                                    <td>{{ $move->created_at }}</td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{action('PopController@history222', $move->id)}}">
                                                        <i class="fa fa-eye"></i> Show
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
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
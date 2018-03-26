@extends('layouts.menu')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <div class="portlet-title">
            <div class="caption">
                <span class="icon-settings font-dark caption-subject font-dark sbold uppercase page-title"> Area {{ Auth::user()->detailuser->area->name }}</span>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>{{ $message }}</strong>
            <a href="" class="alert-link"></a>
        </div>
        @endif
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <p><b>Regional : </b>{{ Auth::user()->detailuser->area->name }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Total Toko : </b>{{ $store->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Request POP: </b>{{ $pop->where('status_id',1)->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>POP Done : </b>{{ $pop->where('status_id',6)->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Total Request Product</span>
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
                        <a>
                        </a>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                            <thead>
                                <tr>
                                    <th class="all">No</th>
                                    <th class="none">Area</th>
                                    <th class="desktop">Dealer ID</th>
                                    <th class="desktop">Store</th>
                                    <th class="none">Posisi</th>
                                    <th class="none">Ukuran</th>
                                    <th class="none">Note</th>
                                    <th class="desktop">Status</th>
                                    <th class="desktop">Created Date</th>
                                    <th class="all">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pop as $pop)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $pop->area->name }}</td>
                                    <td>{{ $pop->store->dealer_id }}</td>
                                    <td>{{ $pop->store->name }}</td>
                                    <td>
                                        @if ($pop->posisi == 1)
                                            <span>Yes</span>
                                        @else
                                            <span>No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pop->ukuran == 1)
                                            <span>Yes</span>
                                        @else
                                            <span>No</span>
                                        @endif
                                    </td>
                                    <td>{{ $pop->note }}</td>
                                    <td>
                                        @if ($pop->status_id == 1)
                                            <span class="badge badge-info">
                                                {{ $pop->status->name }}
                                            </span>
                                        @elseif ($pop->status_id == 2)
                                            <span class="badge badge-warning">
                                                {{ $pop->status->name }}
                                            </span>
                                        @elseif ($pop->status_id == 3)
                                            <span class="badge badge-success">
                                                {{ $pop->status->name }}
                                            </span>
                                        @elseif ($pop->status_id == 4)
                                            <span class="badge badge-success">
                                                {{ $pop->status->name }}
                                            </span>
                                        @elseif ($pop->status_id == 5)
                                            <span class="badge badge-success">
                                                {{ $pop->status->name }}
                                            </span>
                                        @elseif ($pop->status_id == 6)
                                            <span class="badge badge-success">
                                                {{ $pop->status->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $pop->created_at }}</td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>@if ($pop->status_id == 2 || $pop->status_id == 5)
                                                    <a href="{{action('PopController@edit3',$pop->id)}}">
                                                        <i class="fa fa-eye"></i> Edit
                                                    </a>
                                                    @elseif ($pop->status_id == 3)
                                                    <a href="{{action('PopController@edit3',$pop->id)}}">
                                                        <i class="fa fa-eye"></i> Upload
                                                    </a>
                                                    @endif
                                                    <a href="{{action('PopController@show3',$pop->id)}}">
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
@endsection
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
                <span class="icon-settings font-dark caption-subject font-dark sbold uppercase page-title"> Area {{ $area->name }}</span>
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
        <p><b>Regional : </b>{{ $area->name }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Total Toko : </b>{{ $store->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Uploaded : </b>{{ $pop->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Rejected : </b>{{ $pop->where('status_id',2)->count() }}&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Approved : </b>{{ $pop->where('status_id',3)->count() }}</p>
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
{{--                             @foreach ($alls as $all) --}}
                            <tr>                        
{{--                                 <td>{{ $all->name }}</td> 
                                <td><b>{{ $all->sum }}</b></td>   --}}                      
                            </tr> 
{{--                             @endforeach   --}}                                       
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
                                    <th class="desktop">Dealer ID</th>
                                    <th class="desktop">Name Store</th>
                                    <th class="desktop">Grade</th>
                                    <th class="desktop">Request</th>
                                    <th class="desktop">Status</th>
                                    <th class="all">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($store as $store)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $store->dealer_id}}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->grade}}</td>
                                    <td>{{ $store->id}}</td>
                                    <td>
                                        <span class="label label-sm label-success">
                                            {{-- class="label label-sm label-danger"
                                                 class="label label-sm label-info"
                                                --}}
                                            {{ $store->id}}        
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ route('pop.createHr',$store->id) }}">
                                                        <i class="fa fa-eye"></i> Create
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    {!! Form::open(['method' => 'DELETE','route' => ['area.destroy', $store->id],'style'=>'display:inline']) !!}
                                                    <input type="image" src="{{ asset('metronic/assets/global/img/fa-fa-recycle.png') }}" alt="Submit Form" style="cursor: pointer;" />
                                                    {!! Form::close() !!}
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
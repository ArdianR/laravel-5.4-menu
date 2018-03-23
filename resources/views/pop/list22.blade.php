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
                <span class="icon-settings font-dark caption-subject font-dark sbold uppercase page-title"> List Move</span>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>{{ $message }}</strong>
            <a href="" class="alert-link"></a>
        </div>
        @endif
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
                                    <th class="desktop">Area</th>
                                    <th class="desktop">From Store</th>
                                    <th class="desktop">To Store</th>
                                    <th class="none">Note</th>
                                    <th class="desktop">Status</th>
                                    <th class="none">Created Date</th>
                                    <th class="all">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($move as $move)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $move->area->name }}</td>
                                    <td>{{ $move->fromstore->name }}</td>
                                    <td>{{ $move->tostore->name }}</td>
                                    <td>{{ $move->note }}</td>
                                    <td>
                                        @if ($move->status_id == 7)
                                            <span class="badge badge-info">
                                                {{ $move->status->name }}
                                            </span>
                                        @elseif ($move->status_id == 8)
                                            <span class="badge badge-warning">
                                                {{ $move->status->name }}
                                            </span>
                                        @elseif ($move->status_id == 9)
                                            <span class="badge badge-success">
                                                {{ $move->status->name }}
                                            </span>
                                        @elseif ($move->status_id == 10)
                                            <span class="badge badge-success">
                                                {{ $move->status->name }}
                                            </span>
                                        @elseif($move->status_id == 11)
                                            <span class="badge badge-danger">
                                                {{ $move->status->name }}
                                            </span>
                                        @elseif($move->status_id == 12)
                                            <span class="badge badge-danger">
                                                {{ $move->status->name }}
                                            </span>
                                        @elseif($move->status_id == 13)
                                            <span class="badge badge-danger">
                                                {{ $move->status->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $move->created_at }}</td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{action('PopController@show222',$move->id)}}">
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
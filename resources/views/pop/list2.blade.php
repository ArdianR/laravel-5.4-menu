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
                <span class="icon-settings font-dark caption-subject font-dark sbold uppercase page-title"> List Pop</span>
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
{{--                                     <th class="none">Periode</th>
                                    <th class="none">User</th>
                                    <th class="none">Group</th> --}}
                                    <th class="none">Area</th>
                                    <th class="desktop">Dealer ID</th>
                                    <th class="desktop">Store</th>
                                    <th class="desktop">Posisi</th>
                                    <th class="desktop">Ukuran</th>
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
{{--                                     <td>{{ $pop->periode}}</td>
                                    <td>{{ $pop->user->name }}</td>
                                    <td>{{ $pop->group->name }}</td> --}}
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
                                        @else
                                            <span class="badge badge-danger">
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
                                                <li>
                                                    <a href="{{action('PopController@show4',$pop->id)}}">
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
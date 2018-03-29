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
                <span class="icon-settings font-dark caption-subject font-dark sbold uppercase page-title"> Store</span>
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
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <a href="{{ route('store.create') }}" class="btn btn-sm green"> Create New
                        </a>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table-store">
                            <thead>
                                <tr>
                                    <th class="all">No</th>
                                    <th class="desktop">Name</th>
                                </tr>
                            </thead>
{{--                             <tbody>
                                @foreach ($store as $store)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $store->name}}</td>
                                    <td>{{ $store->dealer_id}}</td>
                                    <td>{{ $store->address}}</td>
                                    <td>{{ $store->area->name}}</td>
                                    <td>{{ $store->grade}}</td>
                                    <td>{{ $store->active}}</td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{action('StoreController@show', $store->id)}}">
                                                        <i class="fa fa-eye"></i> Show
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{action('StoreController@edit', $store->id)}}">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    {!! Form::open(['method' => 'DELETE','route' => ['store.destroy', $store->id],'style'=>'display:inline']) !!}
                                                    <input type="image" src="{{ asset('metronic/assets/global/img/fa-fa-recycle.png') }}" alt="Submit Form" style="cursor: pointer;" />
                                                    {!! Form::close() !!}
                                                </li>
                                                <li>
                                                    <a href="{{action('StoreController@create1', $store->id)}}">
                                                        <i class="fa fa-eye"></i> Product Create
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('store.productShow',$store->id) }}">
                                                        <i class="fa fa-eye"></i> Product Show
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('store.productEdit',$store->id) }}">
                                                        <i class="fa fa-pencil"></i> Product Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    {!! Form::open(['method' => 'DELETE','route' => ['store.destroy', $store->id],'style'=>'display:inline']) !!}
                                                    <input type="image" src="{{ asset('metronic/assets/global/img/fa-fa-recycle.png') }}" alt="Submit Form" style="cursor: pointer;" />
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody> --}}
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
{{-- <script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('store/index') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' }
        ]
    });
});
</script> --}}

<script type="text/javascript">
    $(function() {
        var oTable = $('#table-store').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('user.datastore') }}'
            },
            columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name', orderable: false, searchable: false},
        ],
        });
    });
</script>
@endsection
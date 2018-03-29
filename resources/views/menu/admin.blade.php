<!-- BEGIN SIDEBAR -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-bar-chart"></i>
                <span class="title">Management</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{ url('/group') }}" class="nav-link ">
                        <span class="title">Group</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ url('/area') }}" class="nav-link ">
                        <span class="title">Area</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <span class="title">User</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <a href="{{ url('/user') }}" class="nav-link "> List </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('user.active')}}" class="nav-link "> Active </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="{{ url('/status') }}" class="nav-link ">
                        <span class="title">Status</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ url('/product') }}" class="nav-link ">
                        <span class="title">Product</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ url('/store') }}" class="nav-link ">
                        <span class="title">Store</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-bar-chart"></i>
                <span class="title">POP</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{ url('/pop') }}" class="nav-link ">
                        <span class="title">Index</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ url('/pop') }}" class="nav-link ">
                        <span class="title">Show</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link ">
                        <span class="title">Create</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link ">
                        <span class="title">Edit</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link ">
                        <span class="title">Delete</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
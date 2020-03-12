@extends('layouts.default')

@section('title', 'Teacher')

@section('name',  ''.$loggedUser->name)

@section('content')
<!-- BEGIN CONTAINER -->
<div class="page-container" id="app">
    <input type="hidden" id="user_id" value="{{$loggedUser->user_id}}">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse" >
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="100">
                    
                    <li class="nav-item  ">
                        <router-link to="/teacher" >
                            <i class="fa fa-home"></i>
                            <span class="title">Home</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/teacherUMSStudent" class="nav-link ">
                            <i class="fa fa-users"></i>
                            <span class="title">UMS</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/teacherToken" class="nav-link ">
                            <i class="fa fa-barcode"></i>
                            <span class="title">Token</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/teacherStudentList" class="nav-link ">
                            <i class="fa fa-graduation-cap"></i>
                            <span class="title">Batch Students</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/teacherBatch" class="nav-link ">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">Batches</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-building-o"></i>
                            <span class="title">Companies</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  ">
                                <router-link to="/teacherCompany" >
                                    <span class="title">Student Companies</span>
                                </router-link>
                            </li>
                            <li class="nav-item  ">
                                <router-link to="/teacherChangeCompany" >
                                    <span class="title">Company change details</span>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/teacherTA" class="nav-link ">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">Teaching Assistance</span>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link to="/teacherProfile" >
                            <i class="icon-user"></i>
                            <span class="title">Profile Information</span>
                        </router-link>
                    </li>
                    {{-- <li class="nav-item  ">
                        <router-link to="/teacherNotice" class="nav-link ">
                            <i class="fa fa-bell-o"></i>
                            <span class="title">Notice</span>
                            <span id="noticeCount" class="badge"> {{$noticeCount}} </span>
                        </router-link>
                    </li> --}}
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->

        <!-- Begin Content load -->
        <router-view></router-view>

    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler">
        <i class="icon-login"></i>
    </a>
    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<script type="text/javascript">
    window.localStorage.setItem('user', 'teacher');
</script>
@endsection

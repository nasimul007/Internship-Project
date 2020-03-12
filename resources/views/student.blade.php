@extends('layouts.default')

@section('title', 'Student')

@section('name',  ''.$loggedUser->name)

@section('content')
<!-- BEGIN CONTAINER -->
<div class="page-container" id="app">
    <input type="hidden" id="user_id" value="{{$loggedUser->user_id}}">
    <input type="hidden" id="user_name" value="{{$loggedUser->name}}">
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
                        <router-link to="/student">
                            <i class="fa fa-home"></i>
                            <span class="title" >Home</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/studentSupervisor">
                            <i class="fa fa-sticky-note-o"></i>
                            <span class="title" >Supervisor Details</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/studentCompany">
                            <i class="fa fa-building-o"></i>
                            <span class="title" >Company Details</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/studentUpload">
                            <i class="fa fa-upload"></i>
                            <span class="title">Upload</span>
                        </router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link to="/studentProfile" >
                            <i class="icon-user"></i>
                            <span class="title">Profile Information</span>
                        </router-link>
                    </li>
                    {{-- <li class="nav-item  ">
                        <router-link to="/studentNotice" class="nav-link ">
                            <i class="fa fa-bell-o"></i>
                            <span class="title">Notice</span>
                            <span class="badge badge-danger" id="noticeCount"> {{$noticeCount}}  </span>
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

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
@endsection

@section('script')
    
<script type="text/javascript">
    window.localStorage.setItem('user', 'student');
</script>

@endsection
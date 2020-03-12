@extends('layouts.default')

{{-- {{ $loggedUser->name }} --}}

@section('name',  ''.$loggedUser->name)

@section('title', 'Admin')

@section('content')
<!-- BEGIN CONTAINER -->
<div class="page-container" id="app">
<input type="hidden" id="user_id" value="{{$loggedUser->user_id}}">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="100">
            <li class="nav-item">
                <router-link to="/admin" >
                    <i class="fa fa-home"></i>
                    <span class="title">Home</span>
                </router-link>
            </li>
            <li class="nav-item  ">
                <router-link to="/adminTeachers" >
                    <i class="fa fa-user"></i>
                    <span class="title">Teachers</span>
                </router-link>
            </li>
            <li class="nav-item  ">
                <router-link to="/adminSupervisors" >
                    <i class="fa fa-user"></i>
                    <span class="title">Company Supervisors</span>
                </router-link>
            </li>
            <li class="nav-item ">
                <router-link to="/adminCompany" >
                    <i class="fa fa-building-o"></i>
                    <span class="title">Companies</span>
                </router-link>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="title">Student</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <router-link to="/adminStudents" >
                            <span class="title">Students</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/adminApproveRegistration" >
                            <span class="title">Approve Registration</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/adminApproveEnrollment" >
                            <span class="title">Allow Enrollment</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-graduation-cap"></i>
                    <span class="title">Batch</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <router-link to="/adminBatchList" >
                            <span class="title">Batches</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/adminStudentWithoutBatch" >
                            <span class="title">Students Without Batch</span>
                        </router-link>
                    </li>
                    <li class="nav-item  ">
                        <router-link to="/adminRequestToComplete" >
                            <span class="title">Request to complete</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <router-link to="/adminSemester" >
                    <i class="fa fa-clipboard"></i>
                    <span class="title">Semesters</span>
                </router-link>
            </li>
            <li class="nav-item ">
                <router-link to="/adminTA" >
                    <i class="icon-user"></i>
                    <span class="title">Teacher Assistant</span>
                </router-link>
            </li>
            <li class="nav-item ">
                <router-link to="/adminNotice" >
                    <i class="fa fa-bell-o"></i>
                    <span class="title">Notice</span>
                    {{-- <span class="badge badge-danger"> 3 </span> --}}
                </router-link>
            </li>
            <li class="nav-item ">
                <router-link to="/adminProfile" >
                    <i class="icon-user"></i>
                    <span class="title">Profile Information</span>
                </router-link>
            </li>
            
        </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <router-view></router-view>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script type="text/javascript">
    window.localStorage.setItem('user', 'admin');
</script>
@endsection
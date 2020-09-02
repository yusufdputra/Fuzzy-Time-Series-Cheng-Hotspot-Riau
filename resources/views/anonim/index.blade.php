@extends('layout/master')

@section('title', 'Dashboard')

@section('container')
<div class="container-fluid">

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-20">
            <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings </button>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
            </div>
        </div>
        <h4 class="page-title">Starter</h4>
    </div>
</div>
<!-- end page title end breadcrumb -->


</div> <!-- end container -->


<!-- Right Sidebar -->
<div class="side-bar right-bar">
<a href="javascript:void(0);" class="right-bar-toggle">
    <i class="mdi mdi-close-circle-outline"></i>
</a>
<h4 class="">Notifications</h4>
<div class="notification-list nicescroll">
    <ul class="list-group list-no-border user-list">
        <li class="list-group-item">
            <a href="#" class="user-list-item">
                <div class="avatar">
                    <img src="adminto/images/users/avatar-2.jpg" alt="">
                </div>
                <div class="user-desc">
                    <span class="name">Michael Zenaty</span>
                    <span class="desc">There are new settings available</span>
                    <span class="time">2 hours ago</span>
                </div>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="user-list-item">
                <div class="icon bg-info">
                    <i class="mdi mdi-account"></i>
                </div>
                <div class="user-desc">
                    <span class="name">New Signup</span>
                    <span class="desc">There are new settings available</span>
                    <span class="time">5 hours ago</span>
                </div>
            </a>
        </li>
        <li class="list-group-item">
            <a href="#" class="user-list-item">
                <div class="icon bg-pink">
                    <i class="mdi mdi-comment"></i>
                </div>
                <div class="user-desc">
                    <span class="name">New Message received</span>
                    <span class="desc">There are new settings available</span>
                    <span class="time">1 day ago</span>
                </div>
            </a>
        </li>
        <li class="list-group-item active">
            <a href="#" class="user-list-item">
                <div class="avatar">
                    <img src="adminto/images/users/avatar-3.jpg" alt="">
                </div>
                <div class="user-desc">
                    <span class="name">James Anderson</span>
                    <span class="desc">There are new settings available</span>
                    <span class="time">2 days ago</span>
                </div>
            </a>
        </li>
        <li class="list-group-item active">
            <a href="#" class="user-list-item">
                <div class="icon bg-warning">
                    <i class="mdi mdi-settings"></i>
                </div>
                <div class="user-desc">
                    <span class="name">Settings</span>
                    <span class="desc">There are new settings available</span>
                    <span class="time">1 day ago</span>
                </div>
            </a>
        </li>

    </ul>
</div>
</div>
<p>{{Session::get('email')}}</p>
<p>{{Session::get('status_login')}}</p>

<!-- /Right-bar -->
@endsection